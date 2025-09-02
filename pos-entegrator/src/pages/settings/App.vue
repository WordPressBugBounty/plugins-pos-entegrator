<script setup>
import Page from "@/layouts/Page.vue";
import { ref, shallowRef, onMounted } from "vue";
import FormSettings from "@/components/Settings/Tabs/FormSettings.vue";
import TagManagerSettings from "@/components/Settings/Tabs/TagManagerSettings.vue";
import WooCommerce from "@/components/Settings/Tabs/WooCommerce.vue";
import GiveWp from "@/components/Settings/Tabs/GiveWp.vue";
import LearnPress from "@/components/Settings/Tabs/LearnPress.vue";
import WcSubs from "@/components/Settings/Tabs/WcSubs.vue";
import CardSave from "@/components/Settings/Tabs/CardSave.vue";
import CardSaveLocked from "@/components/Settings/Tabs/CardSaveLocked.vue";
import DefaultPayer from "@/components/Settings/Tabs/DefaultPayer.vue";
import DefaultPayerLocked from "@/components/Settings/Tabs/DefaultPayerLocked.vue";
import CurrencyConverter from "@/components/Settings/Tabs/CurrencyConverter.vue";
import CurrencyConverterLocked from "@/components/Settings/Tabs/CurrencyConverterLocked.vue";
import Status from "@/components/Settings/Tabs/Status.vue";
import OtherSettings from "@/components/Settings/Tabs/OtherSettings.vue";
import InsDisplaySettings from "@/components/Settings/Tabs/InsDisplaySettings.vue";
import GoogleSheetSync from "@/components/Settings/Tabs/GoogleSheetSync.vue";
import Gate from "@/components/Settings/Tabs/Gate.vue";
import GateLocked from "@/components/Settings/Tabs/GateLocked.vue";
import NotificationSettings from "@/components/Settings/Tabs/NotificationSettings.vue";
import NavSectionTitle from "@/components/Settings/NavSectionTitle.vue";
import NavElement from "@/components/Settings/NavElement.vue";
import NeedBadge from "@/components/Badges/NeedBadge.vue";
import WebHook from "@/components/Settings/Tabs/WebHook.vue";
import TravelerWP from "@/components/Settings/Tabs/TravelerWP.vue";

const integrations = window.gpos.integrations;
const isProActive = window.gpos.is_pro_active;
const isFormActive = window.gpos.is_form_active;
const rightContent = shallowRef(FormSettings);
const navMenu = ref([
  {
    sectionTitle: "general_settings",
    sections: [
      {
        title: "form_settings",
        icon: "queue-list-icon",
        component: shallowRef(FormSettings),
        active: true,
      },
      {
        title: "tag_manager_settings",
        component: shallowRef(TagManagerSettings),
      },
      {
        title: "notification_settings",
        component: shallowRef(NotificationSettings),
      },
      {
        title: "ins_display_settings",
        component: shallowRef(InsDisplaySettings),
      },
      {
        title: "google_sheet_sync",
        component: isFormActive ? shallowRef(GoogleSheetSync) : false,
        need: "form",
      },
      {
        title: "webhook",
        component: isFormActive ? shallowRef(WebHook) : false,
        need: "form",
      },
    ],
  },
  {
    sectionTitle: "integration_settings",
    sections: [
      {
        title: "woocommerce",
        component: shallowRef(WooCommerce),
      },
      {
        title: "givewp",
        component: shallowRef(GiveWp),
      },
      {
        title: "learn_press",
        component: shallowRef(LearnPress),
      },
      {
        title: "woocommerce_subs",
        component: shallowRef(WcSubs),
      },
      {
        title: "travelerwp",
        component: shallowRef(TravelerWP),
      },
    ],
  },
  {
    sectionTitle: "payment_settings",
    sections: [
      {
        title: "card_save",
        component: shallowRef(isProActive ? CardSave : CardSaveLocked),
        need: "pro",
      },
      {
        title: "gate",
        component: shallowRef(isProActive ? Gate : GateLocked),
        need: "pro",
      },
      {
        title: "currency_converter",
        component: shallowRef(
          isProActive ? CurrencyConverter : CurrencyConverterLocked
        ),
        need: "pro",
      },
      {
        title: "default_payer",
        component: shallowRef(isProActive ? DefaultPayer : DefaultPayerLocked),
        need: "pro",
      },
    ],
  },
  {
    sectionTitle: "other",
    sections: [
      {
        title: "other_settings",
        component: shallowRef(OtherSettings),
      },
      {
        title: "status",
        component: shallowRef(Status),
        errorBadge: true,
      },
    ],
  },
  {
    sectionTitle: "other_products",
    sections: [
      {
        title: "kargo_entegrator",
        url: "https://kargoentegrator.com/?utm_source=wp_plugin&utm_medium=referral&utm_campaign=settings",
        isExternal: true,
      },
      {
        title: "fatura_entegrator",
        url: "https://faturaentegrator.com/?utm_source=wp_plugin&utm_medium=referral&utm_campaign=settings",
        isExternal: true,
      },
    ],
  },
]);

navMenu.value[1].sections = navMenu.value[1].sections.filter((e) =>
  integrations[e.title] ? integrations[e.title] : false
);

const tabToActive = (tab) => {
  navMenu.value.forEach((section) => {
    section.sections.forEach((element) => {
      element.active = element.title === tab;
      if (element.title === tab) {
        rightContent.value = element.component;
      }
    });
  });
};

const openExternalLink = (url) => {
  window.open(url, "_blank");
};

onMounted(() => {
  const hash = window.location.hash.replace("#", "");
  if (hash) {
    tabToActive(hash);
    setTimeout(() => {
      window.scrollTo(0, 0); //tabın oldugu yere odaklandigi icin yukarı cikmasi icin eklendi
    }, 1000);
  }
});
</script>
<template>
  <Page
    :text="$t('settings')"
    href="https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"
  >
    <div class="w-full flex">
      <div class="w-1/5 flex flex-col bg-[#FAFAFA] py-8 rounded-l-lg space-y-8">
        <!-- eslint-disable -->
        <template v-for="menuItem in navMenu" :key="menuItem.sectionTitle">
          <!-- eslint-enable -->
          <div>
            <NavSectionTitle>
              {{ $t(menuItem.sectionTitle) }}
            </NavSectionTitle>

            <!-- Normal menu items -->
            <template v-if="menuItem.sectionTitle !== 'other_products'">
              <NavElement
                v-for="(section, index) in menuItem.sections"
                :id="section.title"
                :key="index"
                :icon="section.title"
                :active="section.active"
                :new-badge="section.newBadge"
                :error-badge="section.errorBadge"
                @click="tabToActive(section.title)"
              >
                {{ $t(section.title) }}
                <NeedBadge
                  v-if="section.need"
                  :type="section.need"
                />
              </NavElement>
            </template>

            <!-- External link items for other_products -->
            <template v-else>
              <NavElement
                v-for="(section, index) in menuItem.sections"
                :id="section.title"
                :key="index"
                :icon="section.title"
                :active="false"
                @click="openExternalLink(section.url)"
              >
                {{ $t(section.title) }}
              </NavElement>
            </template>

            <a
              v-if="menuItem.sectionTitle === 'other'"
              href="https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=documents"
              target="_blank"
            >
              <NavElement
                icon="documents"
                :active="false"
              >
                {{ $t("documents") }}
              </NavElement>
            </a>
          </div>
        </template>
      </div>
      <div class="w-4/5 flex flex-col bg-white rounded-r-lg p-8 relative">
        <component :is="rightContent" />
      </div>
    </div>
  </Page>
</template>
