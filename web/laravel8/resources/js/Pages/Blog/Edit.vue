<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <jet-form-section @submitted="editBlog">
                    <template #title>Blog更新</template>
                    <template #description>Blogの更新を行います</template>
                    

                    <template #form>
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="title" value="タイトル" />
                            <jet-input
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                maxlength="30"
                            />
                            <jet-input-error :message="form.errors.title" class="mt-2" />

                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="content" value="コンテント" />
                            <textarea 
                                v-model="form.content" 
                                class="mt-1 block w-full form-input rounded-md shadow-sm"
                                maxlength="50"
                            >
                            </textarea>
                            <jet-input-error :message="form.errors.content" class="mt-2" />
                        </div>

                    </template>
                    <template #actions>
                        <!--
                        <jet-button
                            class=" bg-green-700 w-full text-base"
                        >
                            Update
                        </jet-button>

                        -->
                        <button 
                            class="
                                bg-green-500 
                                w-full 
                                font-extrabold 
                                text-xl 
                                text-white
                                rounded-md 
                                h-auto 
                                leading-10 
                                hover:bg-gray-700 
                            "
                            >
                                UPDATE
                        </button>

                    </template>

                </jet-form-section>

            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetFormSection from "@/Jetstream/FormSection"
    import JetInput from "@/Jetstream/Input";
    import JetLabel from "@/Jetstream/Label";
    import JetButton from "@/Jetstream/Button";
    import JetInputError from "@/Jetstream/InputError";

    export default {
        props:['blog'],
        components: {
            AppLayout,
            JetFormSection,
            JetInput,
            JetLabel,
            JetButton,
            JetInputError,
        },

        data() {
            return {
                form: this.$inertia.form(
                    {
                        _method: "PUT",
                        title: this.blog.title,
                        content: this.blog.content,
                    },
                    {
                        bag: "blogUpdate",
                        resetOnSuccess: false,
                    }
                )
            };
        },


        methods:{
            editBlog(){
               // console.log('submitted')
                this.form.post(route("blog.update",this.blog.id));
            }
        }
    }
</script>
