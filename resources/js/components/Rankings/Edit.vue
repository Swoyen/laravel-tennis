<template>
    <div class="shadow p-3 mb-5 bg-white rounded">
        <form @submit.prevent="submit_form">
            <div class="form-group">
                Date:
                <br />
                <datepicker
                    :bootstrap-styling="true"
                    v-model="loaded_date"
                    :value="this.loaded_date"
                >
                </datepicker>
                <div class="alert alert-danger" v-if="errors && errors.date">
                    {{ errors.date[0] }}
                </div>
                <br />
            </div>
            Category:
            <br />
            <select class="form-control" v-model="fields.gender">
                <option value="" disabled selected>Select Category</option>
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="mixed">Mixed</option>
            </select>
            <div class="alert alert-danger" v-if="errors && errors.gender">
                {{ errors.gender[0] }}
            </div>
            <br />

            Type:
            <br />
            <select class="form-control" v-model="fields.type">
                <option value="" disabled selected
                    >Select Competition Type</option
                >
                <option value="singles">Singles</option>
                <option value="doubles">Doubles</option>
            </select>
            <div class="alert alert-danger" v-if="errors && errors.type">
                {{ errors.type[0] }}
            </div>
            <br />
            <br />

            Ranking:
            <br />
            <input
                type="number"
                min="0"
                max="1000"
                step="1"
                v-model="fields.ranking"
                class="form-control"
            />
            <div class="alert alert-danger" v-if="errors && errors.ranking">
                {{ errors.ranking[0] }}
            </div>
            <br />

            Player:
            <br />
            <input type="text" v-model="fields.player" class="form-control" />
            <div class="alert alert-danger" v-if="errors && errors.player">
                {{ errors.player[0] }}
            </div>
            <br />

            Country:
            <br />
            <input type="text" v-model="fields.country" class="form-control" />
            <div class="alert alert-danger" v-if="errors && errors.country">
                {{ errors.country[0] }}
            </div>
            <br />

            Age:
            <br />
            <input type="text" v-model="fields.age" class="form-control" />
            <div class="alert alert-danger" v-if="errors && errors.age">
                {{ errors.age[0] }}
            </div>
            <br />

            Points:
            <br />
            <input type="text" v-model="fields.points" class="form-control" />
            <div class="alert alert-danger" v-if="errors && errors.points">
                {{ errors.points[0] }}
            </div>
            <br />

            Tournaments:
            <br />
            <input
                type="text"
                v-model="fields.tournaments"
                class="form-control"
            />
            <div class="alert alert-danger" v-if="errors && errors.tournaments">
                {{ errors.tournaments[0] }}
            </div>
            <br />
            <br />

            <input
                type="submit"
                class="btn btn-primary justify-content-center"
                :value="form_submitting ? 'Saving Ranking' : 'Modify Ranking'"
                :disabled="form_submitting"
            />
        </form>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";

export default {
    data() {
        return {
            errors: {},
            form_submitting: false,
            calendar: "",
            loaded_date: new Date(2020, 12, 12),
            fields: {
                date: "",
                gender: "",
                type: "",
                ranking: "",
                player: "",
                country: "",
                age: "",
                points: "",
                tournaments: ""
            }
        };
    },
    mounted() {
        axios
            .get("/api/rankings/" + this.$route.params.id)
            .then(response => {
                this.fields = response.data.data;

                this.loaded_date = new Date(this.fields.date);
            })
            .catch(error => {
                console.log(error);
            });
    },
    components: {
        Datepicker
    },
    watch: {
        calendar() {
            this.fields.date =
                this.calendar.getFullYear() +
                "-" +
                (this.calendar.getMonth() + 1) +
                "-" +
                this.calendar.getDate();
        }
    },
    methods: {
        submit_form() {
            this.form_submitting = true;
            axios
                .put("/api/rankings/" + this.$route.params.id, this.fields)
                .then(response => {
                    this.$swal.fire({
                        icon: "success",
                        title: "Post updated succesfully"
                    });
                    this.$router.push("/");
                    this.form_submitting = false;
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                        this.form_submitting = false;
                    }
                    this.form_submitting = false;
                });
        }
    }
};
</script>
