<script lang="ts" setup>
import MadPropHeader from "@/components/props/MadPropHeader.vue";
import { Card, CardContent } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";

defineProps<{
    madProps: App.Data.MadPropData[];
    user: App.Data.UserData;
}>();
</script>

<template>
    <Card v-for="(madProp, index) in madProps" :key="`mad-prop-${index}`">
        <CardContent class="flex flex-col items-start p-6">
            <MadPropHeader :mad-prop="madProp" />
            <Separator class="my-2" />
            <p class="mt-2 text-muted-foreground">
                &quot;{{ madProp.message }}&quot;
            </p>
        </CardContent>
    </Card>
</template>
