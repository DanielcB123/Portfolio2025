<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'

defineProps({
  canResetPassword: {
    type: Boolean,
    default: false,
  },
  status: {
    type: String,
    default: '',
  },
})

const page = usePage()

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onSuccess: () => {
      const user = page.props.auth?.user
      if (user && user.api_key) {
        localStorage.setItem('api_key', user.api_key)
      }
    },
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-slate-950 text-slate-100">
    <Head title="Log in" />

    <div class="w-full max-w-md bg-slate-900/80 border border-slate-700 rounded-2xl p-8 shadow-xl">
      <h1 class="text-xl font-semibold mb-6 text-center">TaskFlow Login</h1>

      <div v-if="status" class="mb-4 text-sm font-medium text-emerald-400">
        {{ status }}
      </div>

      <form @submit.prevent="submit" class="space-y-5">
        <div>
          <label for="email" class="block text-sm font-medium text-slate-200">
            Email
          </label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            autocomplete="username"
            required
            class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
          />
          <p v-if="form.errors.email" class="mt-1 text-xs text-red-400">
            {{ form.errors.email }}
          </p>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-slate-200">
            Password
          </label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            autocomplete="current-password"
            required
            class="mt-1 block w-full rounded-lg border border-slate-700 bg-slate-900 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
          />
          <p v-if="form.errors.password" class="mt-1 text-xs text-red-400">
            {{ form.errors.password }}
          </p>
        </div>

        <div class="flex items-center justify-between text-xs text-slate-400">
          <label class="inline-flex items-center gap-2">
            <input
              type="checkbox"
              v-model="form.remember"
              class="rounded border-slate-700 bg-slate-900 text-emerald-500 focus:ring-emerald-500"
            />
            <span>Remember me</span>
          </label>

          <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="text-emerald-400 hover:text-emerald-300"
          >
            Forgot password?
          </Link>
        </div>

        <button
          type="submit"
          :disabled="form.processing"
          class="w-full rounded-lg bg-emerald-500 px-4 py-2 text-sm font-medium text-slate-950 hover:bg-emerald-400 disabled:opacity-60"
        >
          {{ form.processing ? 'Logging in...' : 'Log in' }}
        </button>
      </form>
    </div>
  </div>
</template>
