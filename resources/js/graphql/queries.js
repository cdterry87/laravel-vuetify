import gql from 'graphql-tag'

export const GET_ME = gql`
  {
    me {
      id
      name
      email
    }
  }
`