<template>
	<div class="block-section" id="affix-box">
       <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#latest-words" data-toggle="collapse" >Kata Terbaru <loader :show="loading"></loader> <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
       <div v-if="words" class="collapse in" id="latest-words" v-cloak>
          <div class="list-area">
             <ul class="list-unstyled">
                <li v-for="word in words">
                   <router-link :to="word | url">
                   	<i v-if="word.category.metadata" :class="[word.category.metadata.icon, 'fa-fw']"></i>
                   	{{ word.origin }} ({{ word.locale }})
                   </router-link>
                </li>
             </ul>
          </div>
       </div>
    </div>
</template>

<script>
	export default {
		props: {
			limit: {
				type: Number,
				default: 10
			}
		},

		data() {
			return {
				loading: false,
				words: []
			}
		},

		mounted() {
			const params = {
				limit: this.limit
			}
			axios.get('/glosarium/word/latest', {params}).then(response => {
				this.words = response.data.words;
			});
		},

    filters: {
      url(word) {
        return {
          name: 'glosarium.word.show',
          params: {
            category: word.category.slug,
            word: word.slug
          }
        }
      }
    }
	}
</script>