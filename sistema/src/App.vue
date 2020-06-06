<template>
  <span>
    <FlashMessage :position="'right bottom'"></FlashMessage>
    <router-view></router-view>
  </span>
</template>

<style>
* {
  padding: 0px;
  margin: 0px;
  box-sizing: border-box;
}
</style>
