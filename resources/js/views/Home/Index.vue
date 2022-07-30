<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Test Task</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin: 25px 0 25px 0;">
                    <input class="form-control" placeholder="Type to search" v-model="titles" @input="filterApartments()">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <li class="list-group-item d-flex" style="flex-direction: column;">
                            <b>Bathrooms</b>
                            <div v-for="filter of filterList.bathrooms" class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="bathrooms" :value="filter.bathrooms" v-on:change="filterApartments()">
                                <label class="form-check-label">
                                    {{ filter.bathrooms }}
                                </label>
                            </div>
                        </li>

                        <li class="list-group-item d-flex" style="flex-direction: column;">
                            <b>Bedrooms</b>
                            <div v-for="filter of filterList.bedrooms" class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="bedrooms" :value="filter.bedrooms" v-on:change="filterApartments()">
                                <label class="form-check-label">
                                    {{ filter.bedrooms }}
                                </label>
                            </div>
                        </li>

                        <li class="list-group-item d-flex" style="flex-direction: column;">
                            <b>Storeys</b>
                            <div v-for="filter of filterList.storeys" class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="storeys" :value="filter.storeys" v-on:change="filterApartments()">
                                <label class="form-check-label">
                                    {{ filter.storeys }}
                                </label>
                            </div>
                        </li>

                        <li class="list-group-item d-flex" style="flex-direction: column;">
                            <b>Garages</b>
                            <div v-for="filter of filterList.garages" class="form-check">
                                <input class="form-check-input" type="checkbox" v-model="garages" :value="filter.garages" v-on:change="filterApartments()">
                                <label class="form-check-label">
                                    {{ filter.garages }}
                                </label>
                            </div>
                        </li>

                        <li class="list-group-item d-flex" style="flex-direction: column;">
                            <b>Price range</b>

                            <div v-if="filterList.price" class="prices-wrapper" style="display: flex; gap: 5px;">
                                <div class="price-block">
                                    <label>Min:</label>
                                    <input id="min-price" class="form-control" type="number" :placeholder="filterList.price.min"  @input="filterApartments()">
                                </div>

                                <div class="price-block">
                                    <label>Max:</label>
                                    <input id="max-price" class="form-control" type="number" :placeholder="filterList.price.max"  @input="filterApartments()">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-md-9" style="position: relative" v-bind:style="isLoading ? 'opacity: 0.5' : 'opacity: 1'">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Bedrooms</th>
                                <th scope="col">Bathrooms</th>
                                <th scope="col">Storeys</th>
                                <th scope="col">Garages</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="apartment of apartments">
                                <th scope="row">{{ apartment.id }}</th>
                                <td>{{ apartment.title }}</td>
                                <td>{{ apartment.bedrooms }}</td>
                                <td>{{ apartment.bathrooms }}</td>
                                <td>{{ apartment.storeys }}</td>
                                <td>{{ apartment.garages }}</td>
                                <td>{{ apartment.price }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="apartments.length < 1" class="container">
                        <div class="row text-center">
                            <h3>Nothing Found</h3>
                        </div>
                    </div>

                    <div v-if="isLoading">
                        <img src="@/static/loading.svg" class="loader" alt="loader">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Index',

    mounted() {
        this.getFilterList()
        this.getApartments()
    },

    data() {
        return {
            apartments: [],
            filterList: [],

            titles: '',
            bedrooms: [],
            bathrooms: [],
            storeys: [],
            garages: [],
            prices: [],
            isLoading: null,
        }
    },

    methods: {
        filterApartments() {
            let minPrice = document.querySelector('#min-price').value != 0 ? document.querySelector('#min-price').value : this.filterList.price.min;
            let maxPrice = document.querySelector('#max-price').value  != 0 ? document.querySelector('#max-price').value : this.filterList.price.max;
            this.prices = [minPrice, maxPrice];
            this.getApartments();
        },

        getApartments() {
            this.isLoading = true;
            this.axios.post('/api/apartments', {
                'titles': this.titles,
                'bedrooms': this.bedrooms,
                'bathrooms': this.bathrooms,
                'storeys': this.storeys,
                'garages': this.garages,
                'prices': this.prices,
            })
                .then(response => {
                    console.log(response);
                    this.apartments = response.data.data;
                    this.isLoading = false;
                })
        },

        getFilterList() {
            this.axios.get('/api/apartments/filters')
                .then(response => {
                    console.log(response);
                    this.filterList = response.data;
                })
        },

    },
}
</script>

<style scoped>

</style>
