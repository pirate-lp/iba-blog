<template>
<div>
	<h3>Search Mentioned People</h3>
	<form v-on:submit.prevent="onSubmit" class="pure-form">
				<multiselect
					v-model="person"
					:options="people"
					track-by="id"
					label="identifier"
					:multiple="false"
					:taggable="true"
					@tag="addPeople"
					class="input-multiselect"
					selectLabel=""
					deselect-label=""
					:loading="isLoading"
					@search-change="asyncFind"
					>
				</multiselect>
		<button type="submit" class="pure-button pure-button-primary">Search</button>
	</form>
</div>
</template>

<script>

import app from '../configs/app'
import Multiselect from 'vue-multiselect'
export default {
	name: 'People',
	props: [],
	components: {
		Multiselect
	},
	data () {
		return {
			person: null,
			people: [],
			isLoading: false,
		}
	},
	methods: {
		asyncFind (query) {
	    	this.isLoading = true
	    	
	    	
	    	
/*
	    	$.ajax({
	            url: 'http://lostideaslab.com/people/persons/search/?person=' + encodeURIComponent(query),
	            type: 'GET',
	            error: function() {
	                callback();
	            },
	            success: function(res) {
	                callback(res.slice(0, 10));
	            }
	        });
*/
	    	let self = this;
	    	this.$http.get(app.host + '/modules/people/search/?person=' + encodeURIComponent(query))
			.then(function(response){
				console.log(query)
				self.people = response.data 
				self.isLoading = false
				});
	    	
/*
			ajaxFindCountry(query).then(response => {
				this.countries = response
				
			})
*/
			
	    },
	    addPeople (newPerson) {
				const person = {
					name: newPerson,
				}
				this.people.push(person)
			},
		onSubmit () {
			console.log(this.person);
			if (this.person.id != '') {
				this.$router.push({ name: 'home', query: { mention: this.person.id, identifier: this.person.identifier }})
			} else {
				
			}
		},
	},
	created() {
		
	},
	filters: {
		
	},
	watch: {
	}
}
</script>
