<script lang="ts" setup>
import InputError from "@/components/InputError.vue";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Switch } from "@/components/ui/switch";
import { Icon } from "@iconify/vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.auth.user;
const displaySocials = ref(user.display_socials);

const displaySocialsForm = useForm({
    display_socials: user.display_socials,
});

const socialsForm = useForm({
    x_username: user.x_username,
    linkedin_username: user.linkedin_username,
    github_username: user.github_username,
    pinkary_username: user.pinkary_username,
});

function toggleDisplaySocialsFlag() {
    displaySocials.value = !displaySocials.value;
    displaySocialsForm.display_socials = displaySocials.value;
    displaySocialsForm.patch(route("profile.socials.display.update"), { preserveScroll: true });
}
</script>

<template>
    <section class="mx-auto">
        <Card>
            <CardHeader class="flex flex-row items-end justify-between">
                <div>
                    <CardTitle>
                        Socials
                    </CardTitle>
                    <CardDescription>
                        Link your socials to display for other users.
                    </CardDescription>
                </div>
                <div class="flex items-center space-x-2">
                    <Switch
                        id="display_socials"
                        :aria-disabled="displaySocialsForm.processing"
                        :checked="displaySocials"
                        :default-checked="displaySocialsForm.display_socials"
                        :disabled="displaySocialsForm.processing"
                        @update:checked="toggleDisplaySocialsFlag"
                    />
                    <Label for="display_socials">Display socials</Label>
                </div>
            </CardHeader>
            <CardContent class="grid gap-4">
                <form
                    class="grid gap-6"
                    @submit.prevent="socialsForm.patch(route('profile.socials.update'), { preserveScroll: true })"
                >
                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="x_username"
                                v-model="socialsForm.x_username"
                                :aria-disabled="!displaySocialsForm.display_socials"
                                :disabled="!displaySocialsForm.display_socials"
                                autocomplete="x_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your X handle"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Icon class="text-muted-foreground" icon="prime:twitter" />
                            </span>
                        </div>
                        <InputError :message="socialsForm.errors.x_username" />
                    </div>

                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="linkedin_username"
                                v-model="socialsForm.linkedin_username"
                                :aria-disabled="!displaySocialsForm.display_socials"
                                :disabled="!displaySocialsForm.display_socials"
                                autocomplete="linkedin_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your LinkedIn username"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Icon class="size-5 text-muted-foreground" icon="mdi:linkedin" />
                            </span>
                        </div>
                        <InputError :message="socialsForm.errors.linkedin_username" />
                    </div>

                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="github_username"
                                v-model="socialsForm.github_username"
                                :aria-disabled="!displaySocialsForm.display_socials"
                                :disabled="!displaySocialsForm.display_socials"
                                autocomplete="github_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your GitHub username"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <Icon class="size-5 text-muted-foreground" icon="mdi:github" />
                            </span>
                        </div>
                        <InputError :message="socialsForm.errors.github_username" />
                    </div>

                    <div class="grid gap-2">
                        <div class="relative items-center">
                            <Input
                                id="pinkary_username"
                                v-model="socialsForm.pinkary_username"
                                :aria-disabled="!displaySocialsForm.display_socials"
                                :disabled="!displaySocialsForm.display_socials"
                                autocomplete="pinkary_username"
                                autofocus
                                class="w-full pl-10"
                                placeholder="Enter your Pinkary handle"
                                type="text"
                            />
                            <span class="absolute inset-y-0 start-0 flex items-center justify-center px-2">
                                <svg
                                    class="size-5"
                                    fill="none" height="1024" viewBox="0 0 1024 1024" width="1024"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <circle cx="512" cy="512" fill="#EC4899" r="512" />
                                    <path
                                        clip-rule="evenodd"
                                        d="M375.022 782.938H385.585L388.504 772.787C398.2 739.062 408.734 701.557 420.107 660.277L420.117 660.242C430.551 621.984 441.163 583.726 451.952 545.468C459.439 545.219 468.939 544.603 480.341 543.653C496.01 542.347 513.484 539.967 532.73 536.546C552.862 533.044 572.949 527.799 592.987 520.829C613.395 513.731 632.329 504.389 649.748 492.785C668.139 480.818 683.061 465.944 694.293 448.16C706.045 429.552 711.61 407.7 711.61 383.228C711.61 360.057 705.43 339.287 692.671 321.539C680.899 304.178 665.246 290.011 646.011 278.988C627.549 267.755 607.365 259.479 585.534 254.119C563.876 248.384 542.511 245.479 521.468 245.479C501.989 245.479 482.531 247.471 463.109 251.444C444.074 255.338 426.237 260.117 409.618 265.802L409.563 265.821L409.509 265.84C393.722 271.387 379.742 276.759 367.603 281.962L359.101 285.605V294.855C359.101 302.344 362.725 308.746 366.475 313.567C370.135 318.273 374.328 322.466 379.035 326.127L379.314 326.344L379.603 326.546C382.092 328.289 384.664 329.879 387.238 331.08C389.608 332.186 393.095 333.5 397.115 333.5C401.138 333.5 405.052 332.434 408.337 331.251C411.797 330.005 415.532 328.268 419.459 326.189L419.737 326.042L420.008 325.883C426.54 322.04 435.277 317.652 446.368 312.723L446.563 312.636L446.756 312.544C449.831 311.063 453.133 309.652 456.668 308.316C445.353 334.018 434.841 358.926 425.133 383.039L425.104 383.112L425.075 383.185C412.412 415.687 400.171 448.189 388.351 480.694L388.333 480.742L388.316 480.791C376.911 512.894 365.511 546.462 354.116 581.491C342.751 616.005 330.546 653.252 317.501 693.23L317.464 693.343L317.429 693.456C315.782 698.808 313.922 704.595 311.847 710.82L311.712 711.227L311.601 711.642C309.662 718.912 308.603 726.031 308.603 732.931C308.603 749.453 317.664 762.126 331.69 770.758L331.79 770.819L331.891 770.879C345.313 778.833 359.763 782.938 375.022 782.938ZM615.889 423.985C605.825 438.893 592.099 451.594 574.375 462.004C556.626 472.253 536.548 480.43 514.052 486.456C498.109 490.726 482.19 493.892 466.291 495.961C477.084 459.602 488.321 424.611 500.001 390.987L500.016 390.944C512.485 354.67 525.4 323.063 538.731 296.052C553.277 297.171 567.056 300.298 580.123 305.398L580.176 305.418L580.229 305.438C595.921 311.416 608.16 319.997 617.399 331.012L617.483 331.112L617.569 331.211C626.251 341.179 631.163 354.709 631.163 373.128C631.163 392.812 626.014 409.517 616.024 423.788L615.955 423.886L615.889 423.985Z"
                                        fill="#0F172A"
                                        fill-rule="evenodd"
                                    />
                                    <path
                                        d="M560.932 743.369C560.932 766.565 542.128 785.369 518.932 785.369C495.736 785.369 476.932 766.565 476.932 743.369C476.932 720.173 495.736 701.369 518.932 701.369C542.128 701.369 560.932 720.173 560.932 743.369Z"
                                        fill="#FDF2F8"
                                    />
                                </svg>

                            </span>
                        </div>
                        <InputError :message="socialsForm.errors.github_username" />
                    </div>

                    <div class="flex items-center gap-4">
                        <Button :disabled="socialsForm.processing">
                            Save
                        </Button>

                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p
                                v-if="socialsForm.recentlySuccessful"
                                class="text-sm text-muted-foreground"
                            >
                                Saved.
                            </p>
                        </Transition>
                    </div>
                </form>
            </CardContent>
        </Card>
    </section>
</template>
