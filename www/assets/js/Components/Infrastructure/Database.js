import Dexie from "dexie";

const Database = new  Dexie('yourfeed');

Database.version(1).stores({
  settings: '++id, key, value',
  feed: '++id, title, description, image, last_update_at',
  feed_item: '++id, title, description, image_url, created_at, author'
});

export default Database;