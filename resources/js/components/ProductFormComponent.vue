<template>
    <div class="max-w-3xl mx-auto p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Product Management</h1>

      <form @submit.prevent="createProduct" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
          <input
            v-model="form.name"
            type="text"
            placeholder="Product Name"
            required
            class="block w-full px-4 py-2 border rounded-md shadow-sm"
          />
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
          <textarea
            v-model="form.description"
            placeholder="Product Description"
            class="block w-full px-4 py-2 border rounded-md shadow-sm"
          ></textarea>
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
          <input
            v-model="form.price"
            type="number"
            placeholder="Product Price"
            required
            class="block w-full px-4 py-2 border rounded-md shadow-sm"
          />
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
          <input
            type="file"
            @change="handleFileUpload"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-gray-300 file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100"
          />
        </div>
  
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
          <select
            v-model="form.category_id"
            class="block w-full px-4 py-2 border rounded-md shadow-sm"
          >
            <option disabled selected value="">Select a Category</option>
            <option
              v-for="category in categories"
              :value="category.id"
              :key="category.id"
            >
              {{ category.name }}
            </option>
          </select>
        </div>

        <div class="text-right">
          <button
            type="submit"
            class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow hover:bg-indigo-700"
          >
            Create Product
          </button>
        </div>
      </form>
    </div>
  </template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                form: {
                    name: "",
                    description: "",
                    price: "",
                    image: null,
                    category_id: null,
                },
                categories: [],
            };
        },
        methods: {
            async createProduct() {
                const formData = new FormData();
                for (const key in this.form) {
                    formData.append(key, this.form[key]);
                }

                console.log("Submitting form data:", formData);

                try {
                    await axios.post("http://127.0.0.1:8000/api/products", formData);
                    window.location.href = "/";
                } catch (error) {
                    console.error("Error creating product:", error.response.data);
                }
            },
            handleFileUpload(event) {
                this.form.image = event.target.files[0];
            },
        },
        async mounted() {
            const { data } = await axios.get("http://127.0.0.1:8000/api/categories");
            this.categories = data;
        },
    };
</script>