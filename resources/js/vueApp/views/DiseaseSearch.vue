<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Search for AI-Powered Disease Information</h1>
    <div class="flex mb-4">
      <input v-model="searchTerm" @change="searchDisease('diseasesNameSuggestions')"
        @input="searchDisease()" type="text"
        class="w-full rounded-md border px-4 py-2 focus:outline-blue-500 focus:ring-blue-500"
        placeholder="Enter disease name or symptom">
      <!-- <button @click="searchDisease()"
        class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Search</button> -->
    </div>
    <div v-if="searchSuggestions.length > 0"
      class="absolute z-50 bg-white shadow-md rounded-md  w-full max-h-64 overflow-y-auto">
      <ul class="list-none">
        <li v-for="suggestion in searchSuggestions" :key="suggestion.name" class="p-2 hover:bg-gray-100"
          @click="searchDisease(suggestion.id)">
          <a class="text-gray-700">{{
        suggestion.name }}</a>
        </li>
      </ul>
    </div>
    <div v-if="result !=null && Object.keys(result).length != 0">

      <div class="p-4 border border-gray-300 rounded shadow">
        <h3 class="text-xl font-bold mb-2">{{ result.name }}</h3>
        <p class="mb-4">{{ result.description }}</p>

        <p><strong>symptoms:</strong> {{ result.symptoms }}</p>
        <p><strong>Treatment:</strong> {{ result.treatment }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { ApolloClient } from 'apollo-client';
import { createHttpLink } from 'apollo-link-http';
import { InMemoryCache } from 'apollo-cache-inmemory';
import gql from 'graphql-tag';
import { GET_SEARCH_RESULTS, GET_KEYWORD_SUGGESTIONS } from '@/Mixins/graphqlQueries.js';

// Optional: If you prefer to use `vue-apollo` for Apollo setup within the component
import VueApollo from 'vue-apollo';

const httpLink = createHttpLink({
  uri: 'http://localhost:8000/graphql', // Replace with your GraphQL endpoint
});

const cache = new InMemoryCache();

const apolloClient = new ApolloClient({
  link: httpLink,
  cache,
});
const apolloProvider = new VueApollo({
  defaultClient: apolloClient,
});

export default {
  data() {
    return {
      searchTerm: '',
      result: {},
      isLoading: false,
      searchSuggestions: [],

    }
  },
  methods: {
    async searchDisease(diseasesId = 0) {
      this.isLoading = true;
      if (this.searchTerm.length == 0)
        return;
      try {
        let graphqlFunction = diseasesId == 0 ? GET_KEYWORD_SUGGESTIONS : GET_SEARCH_RESULTS;
        let variables = { name: this.searchTerm }
        if (diseasesId != 0) {
          variables = {
            id: diseasesId
          };

        }
        const { data } = await apolloClient.query({
          query: graphqlFunction,
          variables: variables
        });
        if (diseasesId != 0) {
          this.result = data.FindDiseaseById;
          this.searchSuggestions = [];
          this.searchTerm=this.result.name;
        }
        else {
          this.searchSuggestions = data.diseasesNameSuggestions

        }
      } catch (error) {
        this.error = error;
      } finally {
        this.loading = false;
      }
    },

    graphqlReqest() {


    },
    searchTermSuggestions() {
      // Mock search results for demonstration purposes
      this.searchSuggestions = ['d1', 'd2', 'd3']
    }
  }
}
</script>

<style>
.container {
  max-width: 600px;
}
</style>