<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {
    Head,
    router,
    useForm
} from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Checkbox } from '@/components/ui/checkbox';
import { useStepper } from '@vueuse/core';
import { reactive } from 'vue';

const form = reactive({
    email: '',
    first_name: '',
    last_name: '',

    password: '',
    password_confirmation: '',

    billingAddress: '',
    contractAccepted: false,
});

const stepper = useStepper({
    'user-information': {
        title: 'User information',
        isValid: () => !!form.first_name && !!form.last_name && !!form.email,
    },
    'billing-address': {
        title: 'Billing address',
        isValid: () => form.billingAddress?.trim() !== '',
    },
    'terms': {
        title: 'Terms',
        isValid: () => form.contractAccepted === true,
    },
});

function submit() {
    if (stepper.current.value.isValid() && stepper.isLast.value) {
        console.log('submitting form', form);
        router.post('/register', form);
    } else if (stepper.current.value.isValid()) {
        stepper.goToNext();
    }
}

function allStepsBeforeAreValid(index) {
    return !Array.from({ length: index }, () => null)
        .some((_, i) => !stepper.at(i)?.isValid());
}

</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <div>
            <div class="flex gap-2 justify-center">
                <div v-for="(step, id, i) in stepper.steps.value" :key="id" class="">
                    <Button :disabled="!allStepsBeforeAreValid(i) && stepper.isBefore(id)" @click="stepper.goTo(id)"
                        v-text="step.title" />
                </div>
            </div>

            <form class="mt-10 text-white" @submit.prevent="submit">
                <span class="text-lg font-bold" v-text="stepper.current.value.title" />
                <div class="flex flex-col justify-center gap-2 mt-2">
                    <div>
                        <div v-if="stepper.isCurrent('user-information')">
                            <div class="mb-4">
                                <Label for="email">Email</Label>
                                <Input id="email" v-model="form.email" type="email" />
                            </div>

                            <div class="mb-4">
                                <Label for="first_name">First name:</Label>
                                <Input id="first_name" v-model="form.first_name" class="mt-0.5" type="text" />
                            </div>

                            <div class="mb-4">
                                <Label for="last_name">Last name:</Label>
                                <Input id="last_name" v-model="form.last_name" class="mt-0.5" type="text" />
                            </div>

                            <div class="mb-4">
                                <Label for="password">Password:</Label>
                                <Input id="password" v-model="form.password" class="mt-0.5" type="password" />
                            </div>

                            <div class="mb-4">
                                <Label for="confirm-password">Confirm Password:</Label>
                                <Input id="confirm-password" v-model="form.password_confirmation" class="mt-0.5"
                                    type="password" />
                            </div>
                        </div>

                        <div v-if="stepper.isCurrent('billing-address')">
                            <Input v-model="form.billingAddress" type="text" />
                        </div>

                        <div v-if="stepper.isCurrent('terms')">

                            <div class="flex items-center space-x-2">
                                <Checkbox id="terms" v-bind="form.contractAccepted"
                                    v-on:update:checked="form.contractAccepted = $event" />
                                <label for="terms"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    Accept terms and conditions
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <Button v-if="!stepper.isLast.value" :disabled="!stepper.current.value.isValid()">
                            Next
                        </Button>
                        <Button v-if="stepper.isLast.value" :disabled="!stepper.current.value.isValid()">
                            Submit
                        </Button>
                    </div>
                </div>
            </form>


        </div>
    </GuestLayout>
</template>
