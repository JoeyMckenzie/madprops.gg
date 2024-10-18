<script lang="ts" setup>
import type { Recommendation } from "@/pages/profile/Show.vue";
import PropCard from "@/components/prop/PropCard.vue";
import { Card, CardContent } from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";

defineProps<{
    recommendations: Recommendation[];
    user: App.Data.UserData;
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
