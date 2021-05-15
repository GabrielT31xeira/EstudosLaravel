<template>
 <form @submit.prevent="onSubmit" class="mb-4 w-full md:w-1/3">
    <label for="search" class="block text-sm font-medium text-gray-700"
      >Search Breweries</label
    >
    <div class="mt-1 flex rounded-md shadow-sm">
      <div class="relative flex items-stretch flex-grow focus-within:z-10">
        <div
          class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
        >
          <svg
            class="h-5 w-5 text-gray-400"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
              clip-rule="evenodd"
            />
          </svg>
        </div>
        <input
          v-model="searchTerm"
          type="search"
          name="search"
          id="search"
          class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:text-sm border-gray-300"
          placeholder="John Doe"
        />
      </div>
      <button
        type="submit"
        class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
      >
        <span>Search</span>
      </button>
    </div>
  </form>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div
          class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
        >
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Cervejaria
                </th>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Location
                </th>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Open
                </th>
                <th
                  scope="col"
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Action
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="b in breweries.data" :key="b.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">{{ b.name }},{{ b.id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">
                    {{ b.city }}, {{ b.state }} - {{ b.country }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  Open NOW
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium"
                >
                  <inertia-link
                    :href="route('brewery.beers', b.id )"
                    class="text-indigo-600 hover:text-indigo-900"
                    >Ver mais</inertia-link
                  >
                </td>
              </tr>
            </tbody>
          </table>
          <pagination class="px-6 pb-4" :data="breweries" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from "../Shared/Pagination.vue";
export default {
  // name: "BeerDashboard",
  components: { Pagination },
  props: {
    breweries: Object,
  },
  data() {
    return {
      searchTerm: "",
    };
  },
  computed: {
    shouldHidePagination() {
      return !this.breweries.prev_page_url && !this.breweries.next_page_url;
    },
  },
  methods: {
    onSubmit() {
      this.$inertia.replace(
        this.route("dashboard", { search: this.searchTerm })
      );
    },
  },
};
</script>