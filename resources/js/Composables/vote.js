import {useForm} from "@inertiajs/vue3";

const form = useForm({
  idea: '',
})

export function vote(identifier) {
  form.idea = identifier;

  form.post(route('ideas:vote', identifier), {
    preserveScroll: true,
    preserveState: true,
  })
}
