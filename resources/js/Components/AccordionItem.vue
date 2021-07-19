<template>
  <li class="accordion__item my-3.5 py-6">
    <div 
      class="accordion__trigger flex justify-between items-center"
      :class="{'accordion__trigger_active': visible}"
      @click="open">

      <slot name="accordion-trigger"></slot>
      <div v-if="visible"><cancel-l-icon :fill="'#333333'"/></div>
      <div v-else><expand-icon /></div>
    </div>

    <transition 
      name="accordion"
      @enter="start"
      @after-enter="end"
      @before-leave="start"
      @after-leave="end">

      <div class="accordion__content"
        v-show="visible">
        <ul>
          <slot name="accordion-content"></slot>
        </ul>
      </div>
    </transition>
  </li>
</template>


<script>
import CancelLIcon from "../../assets/CancelLIcon.vue";
import ExpandIcon from '../../assets/ExpandIcon.vue';

export default {
  props: {},
  inject: ["Accordion"],
  components: { CancelLIcon, ExpandIcon },
  data() {
    return {
      index: null
    };
  },
  computed: {
    visible() {
      return this.index == this.Accordion.active;
    }
  },
  methods: {
    open() {
      if (this.visible) {
        this.Accordion.active = null;
      } else {
        this.Accordion.active = this.index;
      }
    },
    start(el) {
      el.style.height = el.scrollHeight + "px";
    },
    end(el) {
      el.style.height = "";
    }
  },
  created() {
    this.index = this.Accordion.count++;
  }
};
</script>

<style scoped>
.accordion__item {
  cursor: pointer;
  position: relative;
}

.accordion-enter-active,
.accordion-leave-active {
  will-change: height, opacity;
  transition: height 0.3s ease, opacity 0.3s ease;
  overflow: hidden;
}

.accordion-enter,
.accordion-leave-to {
  height: 0 !important;
  opacity: 0;
}
</style>
