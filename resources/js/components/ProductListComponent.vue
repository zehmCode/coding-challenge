<template>
    <div class="p-8 max-w-3xl mx-auto">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Product List</h2>
        <a
          href="/products"
          class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Add Product
        </a>
      </div>

      <div class="flex gap-4 mb-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Sort by Price:</label>
          <select
            v-model="sortBy"
            @change="fetchProducts"
            class="block w-full px-4 py-2 border rounded-md shadow-sm sm:text-sm"
          >
            <option value="asc">Low to High</option>
            <option value="desc">High to Low</option>
          </select>
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Filter by Category:</label>
          <select
            v-model="categoryId"
            @change="fetchProducts"
            class="block w-full px-4 py-2 border rounded-md shadow-sm sm:text-sm"
          >
            <option value="">All Categories</option>
            <option
              v-for="category in categories"
              :value="category.id"
              :key="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>
      </div>
  
      <div v-if="loading" class="flex justify-center items-center py-8">
        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-500"></div>
      </div>
  
      <ul v-else class="space-y-4">
        <li
          v-for="product in products"
          :key="product.id"
          class="p-4 border rounded-lg shadow-sm flex items-center gap-4 bg-white hover:bg-gray-50"
        >
          <img
            :src="`storage/${product.image}`"
            alt="Product Image"
            class="h-16 w-16 object-cover rounded-lg"
          />
  
          <div class="flex-grow">
            <span class="block font-medium text-gray-800">{{ product.name }}</span>
            <span class="block text-sm text-gray-600">{{ product.description }}</span>
          </div>
  
          <span class="text-indigo-600 font-semibold">${{ product.price }}</span>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        products: [],
        categories: [],
        loading: true,
        sortBy: "asc",
        categoryId: "",
      };
    },
    mounted() {
      this.fetchCategories();
      this.fetchProducts();
    },
    methods: {
      fetchProducts() {
        this.loading = true;
        axios
          .get("/api/products", {
            params: { sortBy: this.sortBy, category_id: this.categoryId },
          })
          .then((response) => {
            this.products = response.data;
            this.loading = false;
          })
          .catch(() => {
            this.loading = false;
          });
      },
      fetchCategories() {
        axios.get("/api/categories").then((response) => {
          this.categories = response.data;
        });
      },
    },
  };
  </script>
  