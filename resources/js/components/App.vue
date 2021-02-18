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
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default{};
</script
