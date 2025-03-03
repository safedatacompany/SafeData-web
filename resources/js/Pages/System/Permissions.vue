<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    permissions: Object, // Grouped permissions
});

const form = useForm({
    name: "",
    group: "",
});

const editPermission = ref(null);

const submit = () => {
    if (editPermission.value) {
        form.put(route('control.system.permissions.update', editPermission.value.id), {
            onSuccess: () => resetForm()
        });
    } else {
        form.post(route('control.system.permissions.store'), {
            onSuccess: () => resetForm()
        });
    }
};

const edit = (permission) => {
    editPermission.value = permission;
    form.name = permission.name;
    form.group = permission.group;
};

const destroy = (id) => {
    if (confirm("Are you sure?")) {
        form.delete(route('control.system.permissions.destroy', id));
    }
};

const resetForm = () => {
    form.reset();
    editPermission.value = null;
};
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Permissions Management</h2>

        <form @submit.prevent="submit">
            <div>
                <input v-model="form.name" placeholder="Permission Name" class="border p-2 w-full" />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
            </div>
            <div class="mt-2">
                <input v-model="form.group" placeholder="Permission Group" class="border p-2 w-full" />
                <div v-if="form.errors.group" class="text-red-500 text-sm mt-1">{{ form.errors.group }}</div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-3 rounded">
                {{ editPermission ? "Update" : "Add" }} Permission
            </button>

            <button v-if="editPermission" type="button" @click="resetForm"
                class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">
                Cancel
            </button>
        </form>

        <div class="mt-4">
            <div v-for="(group, groupName) in permissions" :key="groupName" class="mt-6">
                <h3 class="text-lg font-bold">{{ groupName }}</h3>
                <ul>
                    <li v-for="permission in group" :key="permission.id"
                        class="border-b p-2 flex justify-between items-center">
                        <strong>{{ permission.name }}</strong>
                        <div>
                            <button @click="edit(permission)"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                            <button @click="destroy(permission.id)"
                                class="bg-red-500 text-white px-3 py-1 rounded ml-2">Delete</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>