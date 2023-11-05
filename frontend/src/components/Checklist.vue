<template>
  <div>
    <button
      v-for="item in items"
      :key="item"
      :class="{ active: isSelected(item) }"
      @click="toggleItem(item)"
    >
      {{ item }}
    </button>
  </div>
</template>

<script>
export default {
  props: ['items', 'value'],
  data() {
    return {
      selectedItems: [], // Initialize as an empty array
    };
  },
  computed: {
    selectedItemsComputed: {
      get() {
        return this.value;
      },
      set(newValue) {
        this.$emit('input', newValue);
      },
    },
  },
  watch: {
    value: {
      immediate: true,
      handler(newValue) {
        this.selectedItems = Array.isArray(newValue) ? newValue : []; // Ensure it's an array
      },
    },
  },
  methods: {
    isSelected(item) {
      return this.selectedItems.includes(item);
    },
    toggleItem(item) {
      if (this.isSelected(item)) {
        // Deselect the item
        this.selectedItems = this.selectedItems.filter((i) => i !== item);
      } else {
        // Select the item
        this.selectedItems = [...this.selectedItems, item];
      }
    },
  },
};
</script>

<style scoped>
@import '../../src/assets/User/css/new.css';
</style>
