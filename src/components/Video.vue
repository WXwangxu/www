<template>
  <div>
    <!--导航条-->
    <swiper :options="swiperOption">
      <swiper-slide>
        <span @click="getTagLessons(0)">全部</span>
      </swiper-slide>
      <swiper-slide v-for="v in tags" :key="v.id">
        <span @click="getTagLessons(v.id)">{{v.tname}}</span>
      </swiper-slide>
      <div class="swiper-pagination" slot="pagination"></div>
    </swiper>
    <!--导航条结束-->

    <!--视频列表-->
    <ul id="videolist">
      <li v-for="v in lessons" :key="v.id">
        <router-link :to="'/page/'+v.id" class="pic">
          <img :src="v.thumb"/>
          <span>{{v.created_at}}</span>
          <i class="iconfont icon-bofang"></i>
        </router-link>
        <a href="" class="title">{{v.title}}</a>
      </li>
    </ul>
    <!--视频列表结束-->
    <ul id="bottom">
      <li>
        <router-link to="/">
          <i class="iconfont icon-shouyeshouye"></i>
          <span>首页</span>
        </router-link>
      </li>
      <li class="cur">
        <router-link to="/video">
          <i class="iconfont icon-icon02"></i>
          <span>视频</span>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
    import Vue from 'vue'
    import axios from 'axios'
    import VueAxios from 'vue-axios'

    Vue.use(VueAxios, axios)
    export default {
        name: 'Video',
        data() {
            return {
                swiperOption: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    freeMode: true,
                    pagination: {
                        clickable: true
                    }
                },
                //所有标签数据
                tags:[],
                //所有课程数据
                lessons:[],
            }
        },
        mounted(){
            //通过钩子自动发送异步请求获取后台轮播图接口数据
            this.getTags();
            this.getLessons();
        },
        methods:{
            getTags(){
                Vue.axios.get('http://laravelvedio.annied.cn/getTags').then((response) => {
                    // console.log(response.data)
                    this.tags = response.data;
                })
            },
            getLessons(){
                Vue.axios.get('http://laravelvedio.annied.cn/getLessons').then((response) => {
                    // console.log(response.data)
                    this.lessons = response.data;
                })
            },
            getTagLessons(id){
                Vue.axios.get('http://laravelvedio.annied.cn/getTagLessons/'+ id).then((response) => {
                    // console.log(response.data)
                    this.lessons = response.data;
                })
            }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  * {
    padding: 0;
    margin: 0;
    color: white;
  }

  a {
    text-decoration: none;
    color: #31343B;
  }

  li {
    list-style: none;
  }

  body {
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    padding-bottom: 15%;
  }

  .swiper-container {
    width: 100%;
    background: #31343B;
    position: fixed;
    left: 0;
    top: 0;
  }
  .swiper-slide {
    float: left;
    width: 30%;
    text-align: center;
    line-height: 3em;
    font-size: 3.5vw;
    color: white;
    position: relative;
  }
  .swiper-slide:active,.swiper-slide:link,.swiper-slide:hover{
    text-decoration: none;
    color: white;
  }
  .swiper-slide.cur:after {
    display: block;
    content: '';
    width: 60%;
    height: 3px;
    background: white;
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
  }

  /*视频列表*/
  #videolist{
    width: 94%;
    margin: 0 auto;
    margin-top: 15%;
    display: flex;
    flex-wrap: wrap;
    justify-content:space-between;
  }
  #videolist li{
    width: 49%;
    margin-top: 10px;
  }
  #videolist li a.pic{
    display: block;
    width: 100%;
    height: 30vw;
    overflow: hidden;
    position: relative;
  }
  #videolist li a.pic img{
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    height: 100%;
    min-width: 100%;
  }
  #videolist li a.pic span{
    line-height: 1.5em;
    font-size: 3vw;
    color: white;
    background: rgba(0,0,0,0.5);
    position: absolute;
    right: 0;
    top: 0;
    padding: 0 2%;
  }
  #videolist li a.pic .iconfont.icon-bofang{
    position: absolute;
    color: rgba(255,255,255,1);
    left: 50%;;
    top: 50%;
    font-size: 8vw;
    transform: translate(-50%,-50%);
    background: rgba(0,0,0,0.4);
    border-radius: 50%;
    line-height: 1em;
  }
  #videolist li a.title{
    display: block;
    text-align: center;
    line-height: 2.5em;
    font-size: 3.2vw;
    color: #31343B;
  }


  /*视频列表结束*/


  /*底部固定导航*/
  #bottom {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    background: #FFFFFF;
    margin: 0;
  }

  #bottom li {
    width: 50%;
    box-sizing: border-box;
  }

  #bottom li i.iconfont {
    color: #888;
    font-size: 6vw;
    display: block;
    text-align: center;
  }

  #bottom li span {
    font-size: 2.6vw;
    display: block;
    text-align: center;
    color: #888;
  }

  #bottom li.cur {
    /*background: #333;*/
  }

  #bottom li.cur i.iconfont {
    color: #333;
  }

  #bottom li.cur span {
    color: #333;
  }
  /*底部固定导航结束*/
</style>
