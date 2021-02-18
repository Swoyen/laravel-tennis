<template>
    <div>
        <div class="shadow p-3 mb-5 bg-white rounded">
            <table class="table">
                <tbody></tbody>
            </table>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <a href="#">Date</a>
                        </th>
                        <th scope="col">
                            <a href="#">Gender</a>
                        </th>
                        <th scope="col">
                            <a href="#">Type</a>
                        </th>
                        <th scope="col">
                            <a href="#">Ranking</a>
                        </th>
                        <th scope="col">
                            <a href="#">Player</a>
                        </th>
                        <th scope="col">
                            <a href="#">Country</a>
                        </th>
                        <th scope="col">
                            <a href="#">Age</a>
                        </th>
                        <th scope="col">
                            <a href="#">Points</a>
                        </th>
                        <th scope="col">
                            <a href="#">Tournaments</a>
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
                        <td>{{ ranking.gender }}</td>
                        <td>{{ ranking.type }}</td>
                        <td>{{ ranking.ranking }}</td>
                        <td>{{ ranking.player }}</td>
                        <td>{{ ranking.country }}</td>
                        <td>{{ ranking.age }}</td>
                        <td>{{ ranking.points }}</td>
                        <td>{{ ranking.tournaments }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- div class="row">
            <pagination
                class="col"
                align="center"
                :data="rankings"
                :limit="10"
                @pagination-change-page="getResults"
            ></pagination>
        </div -->
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
            if(val.length >= 4 || old.length >=4){
                this.getResults();
            }
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
                    this.rankings = response.data;
                    console.log("Help");
                });
        },

    }
};
</script>
