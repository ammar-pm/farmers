module.exports = {

    methods: {
        /**
         * Initialize push state handling for tabs.
         */
        usePushStateForLinks() {

            if (window.location.hash) {
                this.activateLinkForCurrentHash();
            }
        },



        /**
         * Activate the tab for the current hash in the URL.
         */
        activateLinkForCurrentHash() {
            var hash = window.location.hash.substring(2);

            var parameters = hash.split('/');

            hash = parameters.shift();

            this.broadcastTabChange(hash, parameters);
        },


        /**
         * Broadcast that a tab change happened.
         */
        broadcastTabChange(hash, parameters) {
            Bus.$emit('linkHashChanged', hash, parameters);
        }
    }
};
