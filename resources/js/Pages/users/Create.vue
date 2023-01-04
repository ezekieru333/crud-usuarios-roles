<script setup>

defineProps({
  users: Array,
});
function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    Inertia.delete(route("users.destroy", id));
  }
}
</script>
<template>
  <AppLayout title="Users">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </template>
    <div class="col-12">
     
    </div>
  </AppLayout>
</template>