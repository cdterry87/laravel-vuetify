import gql from 'graphql-tag'

export const USER_UPDATE = gql`mutation userUpdate($id: ID!, $name: String!, $email: String!) {
  results: userUpdate(id: $id, name: $name, email: $email) {
    id
    name
    email
  }
}
`

export const USER_CHANGE_PASSWORD = gql`mutation userChangePassword($id: ID!, $password: String!) {
  results: userChangePassword(id: $id, password: $password) {
    id
    name
    email
  }
}
`

export const USER_DELETE = gql`mutation userDelete($id: ID!) {
  results: userDelete(id: $id) {
    id
  }
}
`