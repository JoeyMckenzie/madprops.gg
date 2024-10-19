<script lang="ts" setup>
import { Button } from "@/components/ui/button";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">
                Because a high-five just <br>doesn't cut it anymore.
            </h2>
            <p class="mx-auto mt-6 max-w-xl leading-8 text-muted-foreground">
                Give props to those that deserve. Let your colleagues they're awesome.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <Link :href="route('dashboard')">
                    <Button>
                        Get started
                    </Button>
                </Link>
            </div>
        </div>
    </div>
</template>
