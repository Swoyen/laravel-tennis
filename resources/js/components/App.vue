<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>

            <div class="navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link
                            active-class="active-menu"
                            exact
                            :to="{ name: 'rankings.index' }"
                            class="nav-link"
                            >Posts list
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            active-class="active-menu"
                            exact
                            :to="{ name: 'rankings.create' }"
                            class="nav-link"
                            >Add New Post
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container" style="margin-top:10px">
            <transition-page>
                <router-view></router-view>
            </transition-page>
        </div>
        <footer>foot</footer>
    </div>
</template>

<script>
import TransitionPage from "./Transitions/TransitionPage.vue";
export default {
    name: "App",
    components: {
        TransitionPage
    }
};
</script>

<style>
.App {
    max-width: 42em;
    margin-right: auto;
}
</style>
