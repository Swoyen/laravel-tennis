<template>
    <div>
        <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-end text-right">
            <div class="col-3">
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
            <table class="right table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('date')" href="">Date</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'date' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'date' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('gender') "href="#">Category</a>
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
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('type')" href="#">Type</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'type' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'type' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('ranking')" href="#">Ranking</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'ranking' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'ranking' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('player')" href="#">Player</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'player' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'player' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('country')" href="#">Country</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'country' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'country' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('age')" href="#">Age</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'age' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'ages' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a @click.prevent="changeSort('points')" href="#">Points</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'points' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'points' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            <div>
                                <a href="#" @click.prevent="changeSort('tournaments')" >Tournaments</a>
                                <span
                                v-if="
                                    this.params.sort_field == 'tournaments' &&
                                        this.params.sort_direction == 'asc'
                                "
                                    >&uarr;</span>
                                <span
                                    v-if="
                                        this.params.sort_field == 'tournaments' &&
                                            this.params.sort_direction == 'desc'
                                    "
                                >&darr;</span>
                            </div>
                        </th>
                        <th scope="col">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>
                            <select v-model="params.date" class="form-control">
                                <option value="">All dates</option>
                                <option
                                    v-for="date in dates"
                                    :value="date.date"
                                    >{{ date.date }}</option
                                >
                            </select>
                        </th>
                        <th>
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
                        </th>
                        <th>
                            <select v-model="params.type" class="form-control">
                                <option value="">All Types</option>
                                <option
                                    v-for="ranking_type in types"
                                    :value="ranking_type.type"
                                    >{{ ranking_type.type }}</option
                                >
                            </select>
                        </th>
                        <th>
                            <div class="row">
                                 <span class="col-md-6">Min</span><input min="0" max="100" v-model="ranges.ranking_min" type="number"  class="form-control col-md-6 text-center " style="padding: 0px"></input>
                            </div>
                            <div class="row">
                                 <span class="col-md-6">Max</span><input min="0" max="100" v-model="ranges.ranking_max" type="number"  class="form-control col-md-6 text-center" style="padding: 0px"></input>
                           </div>
                        </th>
                        <th>
                            <input v-model="search" class="form-control"></input>
                        </th>
                        <th>
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
                        </th>
                        <th>
                            <div class="row">
                                 <span class="col-md-6">Min</span><input v-model="ranges.age_min" type="number"  class="form-control col-md-6 text-center " style="padding: 0px"></input>
                            </div>
                            <div class="row">
                                 <span class="col-md-6">Max</span><input v-model="ranges.age_max" type="number" class="form-control col-md-6 text-center" style="padding: 0px"></input>
                           </div>
                        </th>
                        <th>
                            <div class="row">
                                 <span class="col-md-6">Min</span><input v-model="ranges.points_min" type="number" class="form-control col-md-6 text-center " style="padding: 0px"></input>
                            </div>
                            <div class="row">
                                 <span class="col-md-6">Max</span><input v-model="ranges.points_max" type="number"  class="form-control col-md-6 text-center" style="padding: 0px"></input>
                           </div>
                        </th>
                        <th>
                            <div class="row">
                                 <span class="col-md-6">Min</span><input v-model="ranges.tournaments_min" type="number"  class="form-control col-md-6 text-center " style="padding: 0px"></input>
                            </div>
                            <div class="row">
                                 <span class="col-md-6">Max</span><input v-model="ranges.tournaments_max" type="number" class="form-control col-md-6 text-center" style="padding: 0px"></input>
                           </div>
                        </th>
                    </tr>
                    <tr v-for="ranking in rankings.data">
                        <td scope="row">{{ ranking.date }}</td>
                        <td class="text-center">{{ ranking.gender }}</td>
                        <td class="text-right">{{ ranking.type }}</td>
                        <td class="text-right">{{ ranking.ranking }}</td>
                        <td class="text-right">{{ ranking.player }}</td>
                        <td class="text-right">{{ ranking.country }}</td>
                        <td class="text-right">{{ ranking.age }}</td>
                        <td class="text-right">{{ ranking.points }}</td>
                        <td class="text-right">{{ ranking.tournaments }}</td>
                        <td class="text-right">
                            <i @click="edit()" class="action-button bi-pencil-square" style="border:0px; padding:0px; margin: 0px"></i>
                            <i @click="edit()" class="action-button bi-trash" style="border:0px; padding:0px; margin: 0px"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div
            v-if="view_method=='infinte_scroll' && rankings.data"
            v-observe-visiblity="handleScrolledToBottom"
        >asd</div>
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
            axios.get("api/dates").then(response => {
                this.dates = response.data;
            });
        },
        getGenders() {
            axios.get("api/genders").then(response => {
                this.genders = response.data;
            });
        },
        getTypes() {
            axios.get("api/types").then(response => {
                this.types = response.data;
            });
        },
        getCountries() {
            axios.get("api/countries").then(response => {
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
        edit(){

        },
        delete(){

        }
    }
};
</script>
