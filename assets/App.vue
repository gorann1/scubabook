<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from '@/components/HelloWorld.vue'
</script>

<template>
    <header>
        <div class="wrapper">
            <HelloWorld msg="We did it!" />

            <nav>
                <RouterLink to="/">Home</RouterLink>
                <RouterLink to="/about">Projekt</RouterLink>
                <RouterLink to="/lokacije">Lokacije</RouterLink>
                <RouterLink to="/centri">Centri</RouterLink>
            </nav>
        </div>
    </header>

    <RouterView />
</template>

