<script lang="ts" setup>
import { computed } from "vue";

const props = defineProps<{
    checked: boolean;
    value?: unknown;
}>();

const emit = defineEmits(["update:checked"]);

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <input
        v-model="proxyChecked"
        :value="value"
        class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
        type="checkbox"
    >
</template>
