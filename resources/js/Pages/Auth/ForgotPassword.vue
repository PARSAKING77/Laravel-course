<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
defineOptions({
  layout: GuestLayout,
});
defineProps<{
  status?: string;
}>();

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>

    <Head title="Forgot Password" />

    <ui-card>
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Forgot Passwrod?
            Let us know your email to send you a reset passwrod link
        </div>
        <ui-alert v-if="status" type="success">
            {{ status }}
        </ui-alert>

        <form @submit.prevent="submit">
            <div>
                <ui-input type="email"  v-model="form.email" :error="form.errors.email"  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Send verification code
                </PrimaryButton>
            </div>
        </form>
    </ui-card>
</template>