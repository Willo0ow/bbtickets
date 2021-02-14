/* import { mount, createLocalVue } from '@vue/test-utils'
import Dashboard from '../js/components/Dashboard'
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'


describe('Dashboard', () => {
  const localVue = createLocalVue()
  localVue.use(VueRouter)
  const router = new VueRouter()
  let vuetify
  beforeEach(() => {
    vuetify = new Vuetify()
  })
  test('Redirects to cards link', () => {
    const wrapper = mount(Dashboard, {localVue, vuetify, router})
    const planCard = wrapper.findComponent({ ref: 'schedule' }) 
    planCard.trigger('click')
    expect(window.location.href).toBe('http://localhost/#/')
  });
  test('Redirects to cards link', () => {
    const wrapper = mount(Dashboard, {localVue, vuetify, router})
    const analysisCard = wrapper.findComponent({ ref: 'analysis' }) 
    analysisCard.trigger('click')
    expect(window.location.href).toBe('http://localhost/#/')
  });
}); */