<sidebar class="bg-slate-800 h-screen w-64 overflow-y-scroll scrollbar-hide fixed z-10 transition duration-300"
    :class="{ '-translate-x-64': !sidebarOpen }">
    <div class="p-8 md:pl-4 flex md:flex-row-reverse justify-between items-center flex-wrap">
        <svg xmlns="http://www.w3.org/2000/svg" @click="sidebarOpen = false"
            class="text-gray-400 h-6 w-6 cursor-pointer md:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <a href="{{ route('dashboard') }}" class="text-left">
            <x-application-logo class="w-20 h-20 fill-current " />
        </a>
    </div>
    <div class="w-full flex flex-col text-slate-300 nav-links mt-8">
        <div class="w-full flex flex-col">
            <x-navigation-link :href="route('admin.dashboard')" :text="__('Dashboard')" />
            @can('client-read')
                    <x-navigation-link :href="route('admin.client.index')" :text="__('Sister Concerns​ ')" />
                @endcan
            <x-navigation-link :href="route('admin.user.index')" :text="__('Member')" />
            <x-navigation-link :href="route('admin.contact.index')" :text="__('Contact Message')" />
            <x-navigation-link :text="__('Product')">
                @can('brand-read')
                    <x-navigation-link :href="route('admin.brand.index')" :text="__('Brand/ Menu Type')" />
                @endcan
                @can('unit-read')
                    <x-navigation-link :href="route('admin.unit.index')" :text="__('Unit')" />
                @endcan
                @can('category-read')
                    <x-navigation-link :href="route('admin.category.index')" :text="__('Category / Product menu')" />
                @endcan
                @can('subcategory-read')
                    <x-navigation-link :href="route('admin.subcategory.index')" :text="__('Sub Category')" />
                @endcan
                @can('attribute-read')
                    <x-navigation-link :href="route('admin.attribute.index')" :text="__('Attribute')" />
                @endcan
                @can('product-read')
                    <x-navigation-link :href="route('admin.product.index')" :text="__('Product')" />
                @endcan
            </x-navigation-link>

            <x-navigation-link :text="__('Website Settings')">
                @can('sitesetting-read')
                    <x-navigation-link :href="route('admin.sitesetting.index')" :text="__('Site Setting')" />
                @endcan
                @can('slider-read')
                    <x-navigation-link :href="route('admin.slider.index')" :text="__('Slider')" />
                @endcan
                   <x-navigation-link :href="route('admin.blog.index')" :text="__(' News & Event')" />
                   <x-navigation-link :href="route('admin.menu.index')" :text="__(' Sister Concerns Menu')" />
                   <x-navigation-link :href="route('admin.team.index')" :text="__('Board of Advisor')" />
                @can('notice-read')
                    <x-navigation-link :href="route('admin.notice.index')" :text="__('Home Blogs')" />
                @endcan

                @can('slider-read')
                    <x-navigation-link :href="route('admin.gallery.index')" :text="__('Partner')" />
                    <x-navigation-link :href="route('admin.certificate.index')" :text="__('Certificate')" />
                @endcan
                @can('slider-read')
                    <x-navigation-link :href="route('admin.video.index')" :text="__('Video')" />
                @endcan
                @can('termsandcondition-read')
                    <x-navigation-link :href="route('admin.termsandcondition.index')" :text="__('Terms and Condition')" />
                @endcan

                @can('shipping-read')
                    <x-navigation-link :href="route('admin.shipping.index')" :text="__('Shipping')" />
                @endcan
            </x-navigation-link>

            <x-navigation-link :text="__('Access Management')">

                <x-navigation-link :href="route('laratrust.roles-assignment.index')" :text="__('Roles Assignment')" />

                <x-navigation-link :href="route('laratrust.roles.index')" :text="__('Roles')" />
                <x-navigation-link :href="route('laratrust.permissions.index')" :text="__('Permissions')" />
            </x-navigation-link>
        </div>
    </div>
</sidebar>
