<script setup lang="ts">
import EmptyPage from '@/components/EmptyPage.vue';
import Table from '@/components/Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SocialForm from '@/partials/SocialForm.vue';
import { Paginated, Social, type BreadcrumbItem } from '@/types';
import { Cell } from '@/types/table';
import { Head, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    items: Paginated<Social[]>;
    // categories: Categories
    // filters: PostFilters
}>();

const title = 'Socials';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: title,
        href: '/socials',
    },
];

const headers: Cell[] = [
    {
        type: 'text',
        label: 'Name',
    },
    {
        type: 'text',
        label: 'Value',
    },
    {
        type: 'text',
        label: 'Icon',
    },
    {
        type: 'text',
        label: 'Link',
    },
    {
        type: 'text',
        label: 'Delete',
    },
];
const body = computed<Cell[][]>(() => {
    return props.items.data.map((item) => [
        // {
        //     type: 'checkbox',
        //     checked: isSelected(order.id),
        //     onChange: (event: Event) => toggleOrderSelection(order.id, event),
        //     label: 'order-checkbox'
        // },
        {
            type: 'component',
            component: SocialForm,
            props: {
                isUpdate: true,
                item: item,
            },
        },
        {
            type: 'text',
            label: item.value,
        },
        {
            type: 'text',
            label: item.icon ?? '',
        },
        {
            type: 'link',
            label: item.link ?? '',
            href: item.link ?? '',
        },
        {
            type: 'button',
            label: 'Delete',
            variant: 'destructive',
            action: () => router.delete(route('socials.destroy', item.id)),
        },
    ]);
});
</script>

<template>
    <Head :title="title" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <template #page-actions>
            <SocialForm />
        </template>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4" v-if="items.data.length > 0">
            <Table :headers="headers" :body="body"></Table>
            <!-- <Pagination :paginated="items" :filters="filters" /> -->
        </div>
        <EmptyPage v-else>
            <SocialForm />
        </EmptyPage>
    </AppLayout>
</template>
