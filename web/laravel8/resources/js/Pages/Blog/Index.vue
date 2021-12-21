<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog
            </h2>
        </template>
        
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div>
                <jet-nav-link :href="route('blog.create')" :active="route().current('blog.create')">
                    <jet-button class="bg-blue-700 text-base">Blogを作成</jet-button>
                </jet-nav-link>
            </div>

            <table class="text-center w-full">
                <thead class="bg-gray-300 flex  w-full border-black h-18">
                    <tr class="flex w-full  ">
                        <th class="border w-1/12">No.</th>
                        <th class="border w-2/12">title</th>
                        <th class="border w-5/12">content</th>
                        <th class="border w-2/12">update</th>
                        <th class=" w-2/12 mr-4">delete</th>
                    </tr>
                </thead>

                <tbody class="bg-gray-light flex flex-col items-center justify-between overflow-y-scroll w-full " style="height: 60vh">
                    <tr v-for="blog in blogs" :key="blog.id" class="flex w-full  ">
                        <td class="border w-1/12 h-auto leading-10">{{ blog.id }}</td>
                        <td class="border w-2/12 text-left">{{ blog.title }}</td>
                        <td class="border w-5/12 text-left">{{ blog.content }}</td>
                        <td class="border w-2/12 ">
                            <!--
                            <jet-button class="bg-green-500 text-base ">
                                <jet-nav-link :href="route('blog.edit', blog.id)">
                                    UPDATE
                                </jet-nav-link>

                            </jet-button>
                            -->
                            <button 
                                class="
                                    bg-green-500 
                                    w-full 
                                    h-full 
                                    font-extrabold 
                                    text-xs md:text-xl
                                    text-white
                                    rounded-md 
                                    h-auto 
                                    leading-10 
                                    
                                    hover:bg-gray-700 
                                "
                                >
                                <jet-nav-link :href="route('blog.edit', blog.id)">
                                    UPDATE
                                </jet-nav-link>
                            </button>

                        </td>
                        <td class="border w-2/12 w-auto">
                        <!--
                            <jet-button class="bg-red-500 text-base "
                            @click.native="deleteBlog(blog.id)">Delete
                            </jet-button>
                        -->
                            <button 
                                class="
                                    bg-red-500 
                                    w-full 
                                    h-full 
                                    font-extrabold 
                                    text-xs md:text-xl
                                    text-white
                                    rounded-md 
                                    h-auto 
                                    leading-10 
                                    hover:bg-gray-700
                                "
                                @click.native="deleteBlog(blog.id)"
                                >
                            DELETE
                            </button>

                        </td>
                    </tr>

                </tbody>
            </table>




        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";

import JetNavLink from '@/Jetstream/NavLink.vue'

    export default {
        props:['blogs'],

        components: {
            AppLayout,
            JetButton,
            JetNavLink,
        },

        data() {
        return {
            form: this.$inertia.form(
            {
                _method: "DELETE",
            }
            ),
        };
        },

        methods:{
            deleteBlog(id){
            　//console.log(id);
                this.form.post(route("blog.destroy", id), {
                preserveScroll: true,
                });
            }
        }
    }
</script>
