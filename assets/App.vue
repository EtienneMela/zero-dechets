<template>
  <div id="app">
    <Introduction />
    <BtnMusic />
    <div class="c-header">
      <h2 class="c-header__logo">Zero<br />déchets</h2>
      <!--------------->
      <!----  NAV ----->
      <!--------------->
      <nav>
        <ul>
          <li>
            <p
              v-on:click="swiper.slideTo(0, false)"
              class="nav-link slide-1"
              v-bind:class="`${this.index >= 0 ? 'is-active' : ''}`"
            >
              <!-- Etat des lieux -->
            </p>
          </li>
          <li>
            <p
              v-on:click="swiper.slideTo(1, false)"
              class="nav-link slide-2"
              v-bind:class="`${this.index >= 1 ? 'is-active' : ''}`"
            >
              <!-- Alimentation -->
            </p>
          </li>
          <li>
            <p
              v-on:click="swiper.slideTo(2, false)"
              class="nav-link slide-3"
              v-bind:class="`${this.index >= 2 ? 'is-active' : ''}`"
            >
              <!-- hygiène et intimité -->
            </p>
          </li>
          <li>
            <p
              v-on:click="swiper.slideTo(3, false)"
              class="nav-link slide-4"
              v-bind:class="`${this.index >= 3 ? 'is-active' : ''}`"
            >
              <!-- Industrie textile et mode -->
            </p>
          </li>
          <li>
            <p
              v-on:click="swiper.slideTo(4, false)"
              class="nav-link slide-5"
              v-bind:class="`${this.index >= 4 ? 'is-active' : ''}`"
            >
              <!-- Energie et eau -->
            </p>
          </li>
        </ul>
      </nav>
      <div class="btn-next swiper-button-next">
        <div class="content"></div>
        <div class="arrow"></div>
      </div>
    </div>

    <!--------------->
    <!----SLIDER----->
    <!--------------->
    <swiper
      ref="mySwiper"
      :options="swiperOptions"
      @slideChange="changeSwiperIndex"
    >
      <swiper-slide>
        <Slider1 />
      </swiper-slide>

      <swiper-slide>
        <Slider2 />
      </swiper-slide>

      <swiper-slide>
        <Slider3 />
      </swiper-slide>

      <swiper-slide>
        <Slider4 />
      </swiper-slide>

      <swiper-slide>
        <Slider5 />
      </swiper-slide>
      <div class="swiper-pagination" slot="pagination"></div>
    </swiper>
  </div>
</template>

<script>
import { TimelineLite, Back } from "gsap";
const timeline = new TimelineLite();

import Chart from "chart.js";
import planetChartData from "./chart-data.js";
import myBarChart from "./chart-data-2.js";
import myBubbleChart from "./chart-data-3.js";

import { Swiper, SwiperSlide, directive } from "vue-awesome-swiper";
import "swiper/css/swiper.css";
import Slider1 from "./views/Slider-1";
import Slider2 from "./views/Slider-2";
import Slider3 from "./views/Slider-3";
import Slider4 from "./views/Slider-4";
import Slider5 from "./views/Slider-5";
import Introduction from "./views/Introduction";
import BtnMusic from "./components/BtnMusic";

export default {
  components: {
    Swiper,
    SwiperSlide,
    Slider1,
    Slider2,
    Slider3,
    Slider4,
    Slider5,
    Introduction,
    BtnMusic,
  },
  directives: {
    swiper: directive,
  },
  name: "App",
  data() {
    return {
      index: 0,
      next: 0,
      swiperOptions: {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      },
      planetChartData: planetChartData,
      myBarChart: myBarChart,
      myBubbleChart: myBubbleChart,
    };
  },
  computed: {
    swiper() {
      return this.$refs.mySwiper.$swiper;
    },
  },
  mounted() {
    this.createChart("planet-chart", this.planetChartData);
    this.createChart("bar-chart", this.myBarChart);
    this.createChart("bubble-chart", this.myBubbleChart);
  },
  methods: {
    // Chart
    createChart(chartId, chartData) {
      const ctx = document.getElementById(chartId);
      const myChart = new Chart(ctx, {
        type: chartData.type,
        data: chartData.data,
        options: chartData.options,
      });
      console.log(myChart);
    },

    changeSwiperIndex() {
      this.index = this.$refs.mySwiper.$swiper.activeIndex;
      console.log(this.index);
      timeline.from(".c-slide__title", 1, {
        y: 30,
        opacity: 0,
        delay: 0.1,
        ease: Back.easeInOut,
      });
    },

    nextSlide() {
      this.$refs.mySwiper.$swiper.slideNext();
    },
  },
};
</script>

<style lang="scss">
@import "assets/scss/styles";

@import url("https://fonts.googleapis.com/css2?family=Anton&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
</style>
