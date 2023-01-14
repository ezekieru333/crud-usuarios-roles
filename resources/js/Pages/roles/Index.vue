<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'
defineProps({
  roles: Array,
});

const form = useForm();

function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route("roles.destroy", id));
  }
}
</script>
<template>
  <AppLayout title="Roles">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
    </template>
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-4 bg-white border-b border-gray-200">
          <div class="col-12">
            <Link :href="route('roles.create')" class="
                  bg-blue-500
                  hover:bg-blue-700
                  text-white
                  font-bold
                  py-2
                  px-4
                  rounded
                  mb-10
                ">Create Role
            </Link>
            <table class="table-full">
              <thead class="mt-8 text-lg">
                <tr>
                  <th class="border px-4 py-2">ID</th>
                  <th class="border px-4 py-2">Name</th>
                  <th class="border px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="role in roles" :key="role.id">
                  <td class="border px-4 py-2">{{ role.id }}</td>
                  <td class="border px-4 py-2">{{ role.name }}</td>
                  <td class="border px-4 py-2">
                    <Link :href="route('roles.edit', role.id)" class="
                          bg-blue-500
                          hover:bg-blue-700
                          text-white
                          font-bold
                          py-2
                          px-4
                          rounded-full
                        ">Edit</Link>
                    <button @click="destroy(role.id)" class="
                          bg-red-500
                          hover:bg-red-700
                          text-white text-sm
                          font-bold
                          py-2
                          px-4
                          rounded-full
                        ">
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </AppLayout>
</template>
