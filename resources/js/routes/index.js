import RankingsIndex from "../components/Rankings/Index.vue";
import RankingsCreate from "../components/Rankings/Create.vue";
import RankingsEdit from "../components/Rankings/Edit.vue";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            component: RankingsIndex,
            name: "rankings.index"
        },
        {
            path: "/rankings/create",
            component: RankingsCreate,
            name: "rankings.create"
        },
        {
            path: "/rankings/edit/:id",
            component: RankingsEdit,
            name: "rankings.edit"
        }
    ]
};
