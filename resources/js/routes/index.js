import RankingsIndex from "../components/Rankings/Index.vue";

export default {
    mode: "history",
    routes: [
        {
            path: "/",
            component: RankingsIndex,
            name: "rankings.index"
        }
    ]
};
