<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { Home, User, LogOut, Menu, FileText, Settings } from 'lucide-vue-next'

const sidebarOpen = ref(true)

const menuItems = [
    { title: 'Dashboard', route: 'dashboard', icon: Home },
    { title: 'Formulários', route: 'dashboard', icon: FileText },
    { title: 'Configurações', route: 'dashboard', icon: Settings },
]
</script>

<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside :class="[
            'fixed inset-y-0 left-0 z-50 flex flex-col bg-gray-900 text-white transition-all duration-300',
            sidebarOpen ? 'w-64' : 'w-16'
        ]">
            <!-- Header -->
            <div class="flex h-16 items-center justify-between border-b border-gray-700 px-4">
                <span v-if="sidebarOpen" class="text-lg font-bold">Formulário Troca</span>
                <span v-else class="text-lg font-bold">FT</span>
            </div>

            <!-- Menu -->
            <nav class="flex-1 space-y-1 p-2">
                <Link v-for="item in menuItems" :key="item.title" :href="route(item.route)"
                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-300 transition-colors hover:bg-gray-800 hover:text-white"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <component :is="item.icon" class="h-5 w-5 shrink-0" />
                    <span v-if="sidebarOpen">{{ item.title }}</span>
                </Link>
            </nav>

            <!-- Footer -->
            <div class="border-t border-gray-700 p-2">
                <Link :href="route('profile.edit')"
                    class="flex items-center gap-3 rounded-lg px-3 py-2 text-gray-300 transition-colors hover:bg-gray-800 hover:text-white"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <User class="h-5 w-5 shrink-0" />
                    <span v-if="sidebarOpen">Perfil</span>
                </Link>
                <Link :href="route('logout')" method="post" as="button"
                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-red-400 transition-colors hover:bg-gray-800 hover:text-red-300"
                    :class="{ 'justify-center': !sidebarOpen }">
                    <LogOut class="h-5 w-5 shrink-0" />
                    <span v-if="sidebarOpen">Sair</span>
                </Link>
            </div>
        </aside>

        <!-- Main content -->
        <div :class="[
            'flex flex-1 flex-col transition-all duration-300',
            sidebarOpen ? 'ml-64' : 'ml-16'
        ]">
            <!-- Header -->
            <header class="sticky top-0 z-40 flex h-16 items-center gap-4 border-b bg-white px-6 shadow-sm">
                <button @click="sidebarOpen = !sidebarOpen" class="rounded-lg p-2 text-gray-600 hover:bg-gray-100">
                    <Menu class="h-5 w-5" />
                </button>
                <h1 class="text-lg font-semibold text-gray-800">
                    {{ $page.props.auth?.user?.name || 'Bem-vindo' }}
                </h1>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
