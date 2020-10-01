<template>
  <ais-instant-search
    :search-client="searchClient"
    index-name="contacts"
  >
  </ais-instant-search>
</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
  data() {
    $algoliaID = config('algolia.id');
    $algoliaKey = config('algolia.key')
    return {
      searchClient: algoliasearch(
          // need to get these once I setup algolia
        $algoliaID,
        $algoliaKey,
      ),
    };
  },
};
</script>
