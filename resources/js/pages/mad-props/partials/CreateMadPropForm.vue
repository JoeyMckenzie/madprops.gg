<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Calendar } from "@/components/ui/calendar";
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Checkbox } from "@/components/ui/checkbox";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Popover, PopoverContent, PopoverTrigger } from "@/components/ui/popover";
import { Textarea } from "@/components/ui/textarea";
import { cn } from "@/lib/utils";
import { Icon } from "@iconify/vue";
import { useForm } from "@inertiajs/vue3";
import { DateFormatter, type DateValue, getLocalTimeZone } from "@internationalized/date";
import { computed, ref, watchEffect } from "vue";

const props = defineProps<{
    user: App.Data.UserData;
}>();

const MESSAGE_CHARACTER_COUNT = 1000;

const form = useForm({
    user: props.user.username,
    worked_with_from: null,
    worked_with_to: null,
    worked_together_at_company: "",
    message: "",
});

const df = new DateFormatter("en-US", {
    dateStyle: "long",
});

const messageCharacterCount = computed(() => form.message.length);
const workedTogetherEndDateDisabled = ref(false);
const workedTogetherFrom = ref<DateValue | null>(null);
const workedTogetherTo = ref<DateValue | null>(null);

watchEffect(() => {
    if (workedTogetherEndDateDisabled.value) {
        workedTogetherTo.value = null;
    }
});
</script>

<template>
    <Card class="mx-auto mt-12 max-w-xl">
        <CardHeader>
            <CardTitle>
                Give some props
            </CardTitle>
            <CardDescription>
                To give {{ user.username }} some props, fill out the form below. If they choose to accept
                your mad props, it'll be displayed on their profile.
            </CardDescription>
        </CardHeader>
        <CardContent>
            <form
                id="create-mad-props"
                class="grid gap-4"
                @submit.prevent="form.post(route('mad-props.store', {
                    id: user.username,
                }))"
            >
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-2">
                    <div class="grid gap-2">
                        <Label for="email">When did you start working together?</Label>
                        <Popover>
                            <PopoverTrigger as-child>
                                <Button
                                    :class="cn(
                                        'justify-start text-left font-normal',
                                        !workedTogetherFrom && 'text-muted-foreground',
                                    )"
                                    variant="outline"
                                >
                                    <Icon class="mr-2 size-4" icon="mdi:calendar" />
                                    {{
                                        workedTogetherFrom ? df.format(workedTogetherFrom.toDate(getLocalTimeZone())) : "Pick a date"
                                    }}
                                </Button>
                            </PopoverTrigger>
                            <PopoverContent class="w-auto p-0">
                                <Calendar v-model="workedTogetherFrom" initial-focus />
                            </PopoverContent>
                        </Popover>
                    </div>
                    <div class="grid gap-2">
                        <Label for="email">When did you last work together?</Label>
                        <Popover>
                            <PopoverTrigger as-child>
                                <Button
                                    :class="cn(
                                        'justify-start text-left font-normal',
                                        !workedTogetherTo && 'text-muted-foreground',
                                    )"
                                    :disabled="workedTogetherEndDateDisabled"
                                    variant="outline"
                                >
                                    <Icon class="mr-2 size-4" icon="mdi:calendar" />
                                    {{
                                        workedTogetherTo ? df.format(workedTogetherTo.toDate(getLocalTimeZone())) : "Pick a date"
                                    }}
                                </Button>
                            </PopoverTrigger>
                            <PopoverContent class="w-auto p-0">
                                <Calendar v-model="workedTogetherTo" />
                            </PopoverContent>
                        </Popover>
                    </div>
                </div>
                <div class="flex items-center space-x-2 sm:justify-end">
                    <Checkbox
                        id="terms" v-model:checked="workedTogetherEndDateDisabled"
                    />
                    <Label
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                        for="terms"
                    >
                        We still work together
                    </Label>
                </div>
                <div class="grid gap-2">
                    <Label for="worked_together_at_company">Where did you work together?</Label>
                    <Input
                        id="worked_together_at_company"
                        v-model="form.worked_together_at_company"
                        autocomplete="worked_together_at_company"
                        required
                        type="email"
                    />
                    <InputError :message="form.errors.worked_together_at_company" />
                </div>
                <div class="grid gap-2">
                    <Label for="message">Give {{ user.fullName }} some props!</Label>
                    <Textarea
                        id="message"
                        v-model="form.message"
                        :maxlength="MESSAGE_CHARACTER_COUNT"
                        :rows="10"
                        autocomplete="message"
                        required
                        type="email"
                    />
                    <InputError :message="form.errors.message" />
                    <p
                        :class="{ 'text-red-400': MESSAGE_CHARACTER_COUNT - messageCharacterCount < 30 }"
                        class="text-sm text-muted-foreground"
                    >
                        {{ messageCharacterCount }}/{{ MESSAGE_CHARACTER_COUNT }} characters
                    </p>
                </div>
            </form>
        </CardContent>
        <CardFooter>
            <Button class="w-full" form="create-mad-props">
                Submit
            </Button>
        </CardFooter>
    </Card>
</template>
