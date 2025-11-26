<script setup>
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-slate-950 text-slate-100">
    <Head title="Dashboard" />

    <div class="max-w-5xl mx-auto py-10 flex justify-between items-center">
      <h1 class="text-2xl font-semibold mb-4">TaskFlow Board</h1>

      <!-- Logout Button -->
      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="px-3 py-1 rounded-md bg-red-600 hover:bg-red-700 text-sm"
      >
        Logout
      </Link>
    </div>

    <!-- ToDo will add TaskColumn / TaskCard / CreateTaskModal -->
  </div>
</template>
