<template>
  <v-container fluid grid-list-md>
    <div class="text-center mb-4">
      <v-btn outlined color href="/logout">
        <v-icon>mdi-logout</v-icon>Sign Out
      </v-btn>
    </div>
    <div class="mt-5 mb-5">
      <v-divider></v-divider>
    </div>
    <v-layout row>
      <v-flex xs12 sm10 offset-sm1 md6 offset-md3>
        <div class="title text-center mb-3">Account Information</div>
        <Loading v-if="isLoading" />
        <div v-else>
          <v-form
            method="POST"
            id="accountForm"
            @submit.prevent="userUpdate"
            ref="form"
            lazy-validation
          >
            <v-text-field
              color="white"
              label="Full Name"
              filled
              prepend-inner-icon="mdi-account"
              v-model="user.name"
              id="name"
              name="name"
              type="text"
              :rules="[v => !!v || 'Name is required']"
              autocomplete="off"
              required
            ></v-text-field>
            <v-text-field
              color="white"
              label="Email"
              filled
              prepend-inner-icon="mdi-email"
              v-model="user.email"
              id="email"
              name="email"
              type="email"
              :rules="[v => !!v || 'Email is required']"
              autocomplete="off"
              required
            ></v-text-field>
            <div class="text-center">
              <v-btn outlined type="submit" color>Update</v-btn>
            </div>
          </v-form>
        </div>
      </v-flex>
      <v-flex xs12 class="mt-5 mb-5">
        <v-divider></v-divider>
      </v-flex>
      <v-flex xs12 sm10 offset-sm1 md6 offset-md3>
        <div class="title text-center mb-3">Update Password</div>
        <v-form
          method="POST"
          id="accountForm"
          @submit.prevent="userChangePassword"
          ref="form"
          lazy-validation
        >
          <v-text-field
            color="white"
            v-model="password"
            label="Password"
            filled
            prepend-inner-icon="mdi-lock"
            id="password"
            name="password"
            type="password"
            autocomplete="off"
            required
          ></v-text-field>
          <v-text-field
            color="white"
            v-model="password_confirmation"
            label="Confirm Password"
            filled
            prepend-inner-icon="mdi-lock"
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="off"
            required
          ></v-text-field>
          <div class="text-center">
            <v-btn outlined type="submit" color>Update</v-btn>
          </div>
        </v-form>
      </v-flex>
      <v-flex xs12 class="mt-5 mb-5">
        <v-divider></v-divider>
      </v-flex>
      <v-flex xs12 sm10 offset-sm1 md6 offset-md3>
        <div class="title text-center mb-3">Delete Account</div>
        <p class="text-center mb-5">Warning! This will permanently delete your account.</p>
        <v-form
          method="POST"
          id="accountForm"
          @submit.prevent="userDelete"
          ref="form"
          lazy-validation
        >
          <div class="text-center">
            <v-btn outlined type="submit" color="error">Delete Your Account</v-btn>
          </div>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Event from './../events'
import Loading from '../components/Loading'
import { GET_ME } from '../graphql/queries'
import { USER_UPDATE, USER_CHANGE_PASSWORD, USER_DELETE } from '../graphql/mutations'

export default {
  name: 'Account',
  components: {
    Loading
  },
  data() {
    return {
      isLoading: false,
      hasError: false,
      user: [],
      password: '',
      password_confirmation: ''
    }
  },
  apollo: {
    getUser: {
      query: GET_ME,
      watchLoading(isLoading) {
        this.isLoading = isLoading
      },
      update(data) {
        if (!Object.keys(data).length) {
          this.hasError = true
          return
        }
        if (data.me) {
          this.user = data.me
        } else {
          console.error('Failed to load user account.')
        }
      },
      error() {
        this.user = []
        this.hasError = true
      }
    }
  },
  methods: {
    userUpdate() {
      console.log('user', this.user)

      let id = this.user.id
      let name = this.user.name
      let email = this.user.email

      this.$apollo
        .mutate({
          mutation: USER_UPDATE,
          variables: {
            id,
            name,
            email
          }
        })
        .then(response => {
          Event.$emit('alert', {
            message: 'Your account information has been updated successfully.',
            color: 'success'
          })
        })
        .catch(() => {
          console.error('Could not update account information.')
        })
    },
    userChangePassword() {
      let id = this.user.id
      let password = this.password
      let password_confirmation = this.password_confirmation

      if (password !== password_confirmation) {
        Event.$emit('alert', {
          message: 'Passwords do not match.',
          color: 'error'
        })
        return false
      }

      this.$apollo
        .mutate({
          mutation: USER_CHANGE_PASSWORD,
          variables: {
            id,
            password
          }
        })
        .then(response => {
          Event.$emit('alert', {
            message: 'Your password has been changed successfully.',
            color: 'success'
          })

          this.resetPasswordForm()
        })
        .catch(() => {
          console.error('Could not update your password.')
        })
    },
    userDelete() {
      let id = this.user.id

      this.$apollo
        .mutate({
          mutation: USER_DELETE,
          variables: {
            id
          }
        })
        .then(response => {
          Event.$emit('alert', {
            message: 'Your account was deleted successfully.',
            color: 'error'
          })
          window.location.replace('/login')
        })
        .catch(() => {
          console.error('Could not delete your account.')
        })
    },
    resetPasswordForm() {
      this.password = ''
      this.password_confirmation = ''
    }
  }
}
</script>
