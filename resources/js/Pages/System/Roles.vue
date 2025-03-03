<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    roles: Array,
    permissions: Array,
});

const form = useForm({
    name: "",
    permissions: [],
});

const editRole = ref(null);

const submit = () => {
    if (editRole.value) {
        form.put(route('control.system.roles.update', editRole.value.id), {
            onSuccess: () => resetForm()
        });
    } else {
        form.post(route('control.system.roles.store'), {
            onSuccess: () => resetForm()
        });
    }
};

const edit = (role) => {
    editRole.value = role;
    form.name = role.name;
    form.permissions = role.permissions.map((p) => p.name);
};

const destroy = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('control.system.roles.destroy', id));
    }
};

const resetForm = () => {
    form.reset();
    editRole.value = null;
};
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Roles Management</h2>

        <form @submit.prevent="submit">
            <div>
                <input v-model="form.name" placeholder="Role Name" class="border p-2 w-full" />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
            </div>

            <div class="mt-2">
                <label v-for="perm in permissions" :key="perm.id" class="block">
                    <input type="checkbox" v-model="form.permissions" :value="perm.name" />
                    {{ perm.name }}
                </label>
                <div v-if="form.errors.permissions" class="text-red-500 text-sm mt-1">{{ form.errors.permissions }}
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-3 rounded">
                {{ editRole ? "Update" : "Add" }} Role
            </button>

            <button v-if="editRole" type="button" @click="resetForm"
                class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </button>
        </form>

        <ul class="mt-4">
            <li v-for="role in roles" :key="role.id" class="border-b p-2 flex justify-between items-center">
                <div>
                    <strong>{{ role.name }}</strong>
                    <span class="text-sm text-gray-600">({{ role.permissions.map(p => p.name).join(', ') }})</span>
                </div>
                <div>
                    <button @click="edit(role)" class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                    <button @click="destroy(role.id)"
                        class="bg-red-500 text-white px-3 py-1 rounded ml-2">Delete</button>
                </div>
            </li>
        </ul>
    </div>
</template>