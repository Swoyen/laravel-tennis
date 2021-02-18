import RankingsIndex from "../components/Rankings/Index.vue";
import RankingsCreate from "../components/Rankings/Create.vue";

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
        }
    ]
};
