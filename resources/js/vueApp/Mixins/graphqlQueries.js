import gql from 'graphql-tag';

export const GET_KEYWORD_SUGGESTIONS = gql`
  query diseasesNameSuggestions($name: String!) {
    diseasesNameSuggestions(name: $name) {
      name
      id
    }
  }
`;

export const GET_SEARCH_RESULTS = gql`
  query FindDiseaseById($id: ID!) {
    FindDiseaseById(id: $id) {
      name
      id
      description
      symptoms
      treatment
    }
  }
`;