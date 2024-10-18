<script lang="ts" setup>
import PropCard from "@/components/prop/PropCard.vue";
import { Card, CardContent } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";

defineProps<{
    recommendations: App.ValueObjects.UserProp[];
    user: App.ValueObjects.UserProp;
}>();
</script>

<template>
    <Card v-for="(recommendation, index) in recommendations" :key="`recommendation-${index}`">
        <CardContent class="flex flex-col items-start p-6">
            <PropCard :recommendation="recommendation" />
            <Separator class="my-2" />
            <p class="mt-2 text-muted-foreground">
                &quot;{{ recommendation.message }}&quot;
            </p>
        </CardContent>
    </Card>
</template>
