<template>
    <div class="shadow p-3 mb-5 bg-white rounded">
        <form @submit.prevent="submit_form">
            <div class="form-group">
                Date:
                <br />
                <datepicker
                    :bootstrap-styling="true"
                    v-model="calendar"
                    placeholder="Select Date"
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
                :value="form_submitting ? 'Saving Post' : 'Save a post'"
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
                .post("/api/rankings", this.fields)
                .then(response => {
                    this.$swal.fire({
                        icon: "success",
                        title: "Post added succesfully."
                    });
                    this.$router.push("/");
                    this.form_submitting = false;
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.$swal.fire({
                            icon: "error",
                            title: "Please check your details."
                        });
                        console.log(error.response.data.errors);
                        this.errors = error.response.data.errors;
                        this.form_submitting = false;
                    }
                    this.form_submitting = false;
                });
        }
    }
};
</script>
