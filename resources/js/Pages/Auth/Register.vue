<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextInput from '@/components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Checkbox } from '@/components/ui/checkbox';
import { useStepper } from '@vueuse/core';
import { reactive } from 'vue';

const form = reactive({
    firstName: 'Jon',
    lastName: '',
    billingAddress: '',
    contractAccepted: false,
    carbonOffsetting: false,
    payment: 'credit-card',
});

const stepper = useStepper({
    'user-information': {
        title: 'User information',
        isValid: () => form.firstName && form.lastName,
    },
    'billing-address': {
        title: 'Billing address',
        isValid: () => form.billingAddress?.trim() !== '',
    },
    'terms': {
        title: 'Terms',
        isValid: () => form.contractAccepted === true,
    },
    'payment': {
        title: 'Payment',
        isValid: () => ['credit-card', 'paypal'].includes(form.payment),
    },
});

function submit() {
    if (stepper.current.value.isValid())
        stepper.goToNext();
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
                            <span>First name:</span>
                            <Input v-model="form.firstName" class="!mt-0.5" type="text" />
                            <span>Last name:</span>
                            <Input v-model="form.lastName" class="!mt-0.5" type="text" />
                        </div>

                        <div v-if="stepper.isCurrent('billing-address')">
                            <Input v-model="form.billingAddress" type="text" />
                        </div>

                        <div v-if="stepper.isCurrent('terms')">
                            <div>
                                <Checkbox id="carbon-offsetting" v-model="form.carbonOffsetting" />
                                <Label for="carbon-offsetting">I accept to deposit a carbon offsetting fee</Label>
                            </div>
                            <div>
                                <Checkbox id="contract" v-model="form.contractAccepted" />
                                <Label for="contract">I accept the terms of the contract</Label>
                            </div>
                            <div>
                                <Checkbox id="terms" />
                                <label for="terms"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                                    Accept terms and conditions
                                </label>
                            </div>
                        </div>

                        <div v-if="stepper.isCurrent('payment')">
                            <div>
                                <Input id="credit-card" v-model="form.payment" type="radio" class="mr-2"
                                    value="credit-card" />
                                <Label for="credit-card">Credit card</Label>
                            </div>
                            <div>
                                <Input id="paypal" v-model="form.payment" type="radio" class="mr-2" value="paypal" />
                                <Label for="paypal">PayPal</Label>
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
