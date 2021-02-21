<template>
    <div>
        <div class="shadow p-3 mb-5 bg-white rounded">


            <div class="row justify-content-end text-right">
                <div class="col-3 text-left">
                    <span @click="toggleFilter()" class="filter-button text-left font-weight-bold" style="padding-top:10px"> Filter Records
                        <span class="col"
                                v-if="
                                    this.filter_shown == true
                                "
                                    >&uarr;
                            </span>
                            <span class="col"
                                    v-if="
                                         this.filter_shown == false
                                    "
                                >&darr;
                                </span>
                        </span>
                </div>
                <div class="col-4">
                    <p class="text-right font-weight-bold" style="padding-top:10px">Records per page:
                    </p>
                </div>
                <div class="col-3">
                    <select v-model="view_method" class="form-control" >
                        <option value="pagination">Pagination</option>
                        <option value="infinte_scroll">Infinite records</option>
                    </select>
                </div>
            </div>
             <div class="row" :ref="'filterer'" style="display:none">
                <div class="col-10 justify-content-start filter">
                <div class=" row">
                    <div class="col-3 text-right">
                        <b>Date:</b>
                    </div>
                    <div class="col-8">
                        <select v-model="params.date" class="form-control">
                            <option value="">All dates</option>
                            <option
                                v-for="date in dates"
                                :value="date.date"
                                >{{ date.date }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Category:</b>
                    </div>
                    <div class="col-8">
                        <select
                            v-model="params.gender"
                            class="form-control"
                        >
                            <option value="">All Genders</option>
                            <option
                                v-for="gender in genders"
                                :value="gender.gender"
                                >{{ gender.gender }}</option
                            >
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Types:</b>
                    </div>
                    <div class="col-8">
                        <select v-model="params.type" class="form-control">
                            <option value="">All Types</option>
                            <option
                                v-for="ranking_type in types"
                                :value="ranking_type.type"
                                >{{ ranking_type.type }}</option
                            >
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Rankings:</b>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <span class="col-md-6 text-right">Min</span><input min="0" max="100" v-model="ranges.ranking_min" type="number"  class="form-control col-md-6 text-center " style="padding: 0px"></input>
                        </div>
                        <div class="row">
                            <span class="col-md-6 text-right">Max</span><input min="0" max="100" v-model="ranges.ranking_max" type="number"  class="form-control col-md-6 text-center" style="padding: 0px"></input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Player:</b>
                    </div>
                    <div class="col-8">
                        <input v-model="search" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Country:</b>
                    </div>
                    <div class="col-8">
                        <select
                            v-model="params.country"
                            class="form-control"
                        >
                            <option value="">Country</option>
                            <option
                                v-for="country in countries"
                                :value="country.country"
                                >{{ country.country }}</option
                            >
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Age:</b>
                    </div>
                    <div class="col-8">
                        <div class="row text-right">
                            <div class="col-6">Min</div><input v-model="ranges.age_min" type="number" class="form-control col-6 text-center " style="padding: 0px"></input>
                        </div>
                        <div class="row text-right">
                            <div class="col-6">Max</div><input v-model="ranges.age_max" type="number" class="form-control col-6 text-center" style="padding: 0px"></input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Points:</b>
                    </div>
                    <div class="col-8">
                        <div class="row text-right">
                            <span class="col-6">Min</span><input v-model="ranges.points_min" type="number" class="form-control col-6 text-center " style="padding: 0px"></input>
                        </div>
                        <div class="row text-right">
                            <span class="col-6">Max</span><input v-model="ranges.points_max" type="number"  class="form-control col-6 text-center" style="padding: 0px"></input>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-right">
                        <b>Tournaments</b>
                    </div>
                    <div class="col-8">
                        <div class="row text-right">
                            <span class="col-6">Min</span><input v-model="ranges.tournaments_min" type="number"  class="form-control col-6 text-center " style="padding: 0px"></input>
                        </div>
                        <div class="row text-right">
                            <span class="col-6">Max</span><input v-model="ranges.tournaments_max" type="number" class="form-control col-6 text-center" style="padding: 0px"></input>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <table class="right table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <div class="row text-right">
                                <a class="col-7" @click.prevent="changeSort('date')" href="">Date</a>
                                <span class="col-2"
                                v-if="
                                    this.params.sort_field == 'date' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class="col-2"
                                    v-if="
                                        this.params.sort_field == 'date' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col" class= "d-none d-lg-block d-xl-block">
                            <div class="row text-right">
                                <a class="col-9" @click.prevent="changeSort('gender') "href="#">
                                Category
                                <span
                                v-if="
                                    this.params.sort_field == 'gender' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'gender' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span></a>
                            </div>
                        </th>
                        <th scope="col" >
                            <div class="row text-center">
                                <a class="col-6" @click.prevent="changeSort('type')" href="#">Type </a>
                                <span class="col-6"
                                v-if="
                                    this.params.sort_field == 'type' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class="col-6"
                                    v-if="
                                        this.params.sort_field == 'type' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="row justify-content-end text-right">
                                <a class="" @click.prevent="changeSort('ranking')" href="#">Ranking</a>
                                <span class=""
                                v-if="
                                    this.params.sort_field == 'ranking' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class=""
                                    v-if="
                                        this.params.sort_field == 'ranking' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="row justify-content-end">
                                <a class="" @click.prevent="changeSort('player')" href="#">Player</a>
                                <span class=""
                                v-if="
                                    this.params.sort_field == 'player' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class=""
                                    v-if="
                                        this.params.sort_field == 'player' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col" class= "d-none d-lg-block d-xl-block">
                            <div class="row justify-content-end">
                                <a class="" @click.prevent="changeSort('country')" href="#">Country</a>
                                <span class=""
                                v-if="
                                    this.params.sort_field == 'country' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class=""
                                    v-if="
                                        this.params.sort_field == 'country' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="row justify-content-end">
                                <a class="" @click.prevent="changeSort('age')" href="#">Age</a>
                                <span class=""
                                v-if="
                                    this.params.sort_field == 'age' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class=""
                                    v-if="
                                        this.params.sort_field == 'ages' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col" class= "d-none d-lg-block d-xl-block">
                            <div class="row justify-content-end">
                                <a class="" @click.prevent="changeSort('points')" href="#">Points</a>
                                <span class=""
                                v-if="
                                    this.params.sort_field == 'points' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class=""
                                    v-if="
                                        this.params.sort_field == 'points' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="row justify-content-end">
                                <a class="" href="#" @click.prevent="changeSort('tournaments')" >Tournaments</a>
                                <span class=""
                                v-if="
                                    this.params.sort_field == 'tournaments' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span class=""
                                    v-if="
                                        this.params.sort_field == 'tournaments' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th class="text-right d-none d-lg-block d-xl-block"scope="col">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody>

                    <template v-for="ranking in rankings.data">
                        <tr>
                            <td class="text-left" scope="row">
                                <i @click="showFields(ranking.id)" class="d-lg-none d-xl-none bi-plus-square-fill" style="font-size: 1.5rem; color: cornflowerblue;"></i>

                                {{ ranking.date }}
                            </td>
                            <td class="d-none d-lg-block d-xl-block text-right">{{ ranking.gender }}</td>
                            <td >{{ ranking.type }}</td>
                            <td class="text-right">{{ ranking.ranking }}</td>
                            <td class="text-right">{{ ranking.player }}</td>
                            <td class="d-none d-lg-block d-xl-block text-right">{{ ranking.country }}</td>
                            <td class="text-right">{{ ranking.age }}</td>
                            <td class="d-none d-lg-block d-xl-block text-right">{{ ranking.points }}</td>
                            <td class="text-right">{{ ranking.tournaments }}</td>

                            <td class="d-none d-lg-block d-xl-block text-right">
                                <router-link
                                    data-toggle="tooltip" data-placement="top" title="Edit"

                                    :to="{
                                        name: 'rankings.edit',
                                        params: { id: ranking.id }
                                    }"
                                    >
                                    <i class="action-button bi-pencil-square" ></i>
                                </router-link>
                                <i data-toggle="tooltip" data-placement="top" title="Delete" @click="delete_ranking(ranking.id)" class="action-button bi-trash" id="delete-button"></i>
                            </td>

                        </tr>

                        <tr class="d-lg-none d-xl-none">
                            <td colspan="10" :id="ranking.id" style="display:none" :ref="ranking.id">

                                <div class="row">
                                    <div class="col-12">
                                        <b>Category:</b>
                                    </div>
                                    <div class="col-12">
                                        {{ ranking.gender}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b>Country:</b>
                                    </div>
                                    <div class="col-12">
                                        {{ ranking.country }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b>Points:</b>
                                    </div>
                                    <div class="col-12">
                                        {{ ranking.points }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <b>Actions:</b>
                                    </div>
                                    <div class="col-12">
                                       <router-link
                                         data-toggle="tooltip" data-placement="top" title="Edit"
                                         :to="{
                                        name: 'rankings.edit',
                                        params: { id: ranking.id }
                                        }"
                                        >
                                            <i class="action-button bi-pencil-square" ></i>
                                        </router-link>
                                        <i data-toggle="tooltip" data-placement="top" title="Delete" @click="delete_ranking(ranking.id)" class="action-button bi-trash" id="delete-button"></i>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>

                </tbody>
            </table>
        </div>
        <div
            v-if="view_method=='infinte_scroll' && rankings.data"
            v-observe-visiblity="handleScrolledToBottom"
        ></div>
        <div class="row">
            <pagination
                v-if="view_method=='pagination'"
                class="col"
                align="center"
                :data="rankings"
                :limit="10"
                @pagination-change-page="getResults"
            ></pagination>
        </div>
    </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
export default {
    data() {
        return {
            rankings: {},
            dates: {},
            genders: {},
            types: {},
            countries: {},
            search: "",
            view_method:"pagination",
            page: 1,
            last_page: 1,
            filter_shown: false,
            ranges: {
                ranking_min: 0,
                ranking_max: 100,
                age_min: 0,
                age_max: 100,
                points_min: 0,
                points_max: 10000,
                tournaments_min: 0,
                tournaments_max: 10000
            },
            params: {
                date: "",
                gender: "",
                type: "",
                country: "",
                sort_field: "date",
                sort_direction: "desc",
            }
        };
    },
    components: {
        pagination
    },
    watch: {
        params: {
            handler() {
                this.getResults();
            },
            deep: true
        },
        ranges: {
            handler() {
                if((this.ranges.ranking_max >= this.ranges.ranking_min) &&
                    (this.ranges.age_max >= this.ranges.age_min) &&
                    (this.ranges.points_max >= this.ranges.points_min) &&
                    (this.ranges.tournaments_max >= this.ranges.tournaments_min)){

                    this.getResults();
                }
            },
            deep: true
        },
        search(val, old) {
            if(val.length >= 3 || old.length >= 3){
                this.getResults();
            }
        },
        view_method(){
            this.getResults();
        }
    },
    mounted() {
        this.getResults();
        this.getDates();
        this.getTypes();
        this.getCountries();
        this.getGenders();
    },
    methods: {
        getDates() {
            axios.get("/api/dates").then(response => {
                this.dates = response.data;
            });
        },
        getGenders() {
            axios.get("/api/genders").then(response => {
                this.genders = response.data;
            });
        },
        getTypes() {
            axios.get("/api/types").then(response => {
                this.types = response.data;
            });
        },
        getCountries() {
            axios.get("/api/countries").then(response => {
                this.countries = response.data;
            });
        },
        getResults(page = 1) {
            axios
                .get(
                    "/api/rankings",
                    {
                        params: {
                            page,
                            search: this.search.length >=3? this.search : '',
                            ranking_range : this.ranges.ranking_max >= this.ranges.ranking_min ? this.ranges.ranking_min + '-' + this.ranges.ranking_max : '',
                            age_range: this.ranges.age_max >= this.ranges.age_min ? this.ranges.age_min + '-' + this.ranges.age_max : '',
                            points_range: this.ranges.points_max >= this.ranges.points_min ? this.ranges.points_min + '-' + this.ranges.points_max : '',
                            tournament_range: this.ranges.tournaments_max >= this.ranges.tournaments_min ? this.ranges.tournaments_min + '-' + this.ranges.tournaments_max : '',
                            ...this.params
                        }
                    }
                )
                .then(response => {
                    this.rankings = response.data;
                    this.last_page = response.data.meta.last_page;
                });
        },
        addResults(page) {
            axios
                .get(
                    "/api/rankings",
                    {
                        params: {
                            page,
                            search: this.search.length >=4? this.search : '',
                            ranking_range : this.ranges.ranking_max >= this.ranges.ranking_min ? this.ranges.ranking_min + '-' + this.ranges.ranking_max : '',
                            age_range: this.ranges.age_max >= this.ranges.age_min ? this.ranges.age_min + '-' + this.ranges.age_max : '',
                            points_range: this.ranges.points_max >= this.ranges.points_min ? this.ranges.points_min + '-' + this.ranges.points_max : '',
                            tournament_range: this.ranges.tournaments_max >= this.ranges.tournaments_min ? this.ranges.tournaments_min + '-' + this.ranges.tournaments_max : '',
                            ...this.params
                        }
                    }
                )
                .then(response => {
                    this.rankings.data.push(...response.data.data);
                });
        },

        changeSort(sort_field){
            if(this.params.sort_field === sort_field){
                this.params.sort_direction =
                    this.params.sort_direction === "asc" ? "desc" : "asc";
            }
            else{
                this.params.sort_field = sort_field;
                this.params.sort_direction = "asc";
            }
            this.getResults();
        },
        handleScrolledToBottom(isVisible) {
            if (!isVisible) {
                return;
            }
            if (this.page >= this.lastPage) {
                return;
            }
            this.page++;
            this.addResults(this.page);
        },
        delete_ranking(ranking_id){
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "This action is irreversible!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#308d56",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                })
                .then(result => {
                    if(result.isConfirmed){
                        axios
                        .delete("/api/rankings/" + ranking_id)
                        .then(response => {
                            this.$swal.fire({
                                icon: "success",
                                title: "Record deleted succesfully!"
                            });
                            this.getResults();
                        })
                        .catch(error => {
                            this.$swal.fire({
                                icon: "error",
                                title: "couldnt delete?"
                            });
                        });
                    }
                    else{
                        this.getResults();
                    }

                });
        },
        showFields(id){
            var div = (this.$refs[id])[0];
            if(div.style.display == "none"){
                div.style.display = "block"
            }
            else{
                div.style.display = "none"
            }

        },
        toggleFilter(){
            var filter = this.$refs.filterer;
            if(filter.style.display == "none"){
                this.filter_shown = true;
                filter.style.display = "block"
            }
            else{
                this.filter_shown = false;
                filter.style.display = "none"
            }
        }
    }
};
</script>

<style>
    #delete-button{
        color:rgb(178,34,34);
    }
    .filter{
        border:1px solid black;
        margin: 10px;
        padding: 20px 0px;
    }
    .filter-button{
        cursor:pointer;
    }
</style>
