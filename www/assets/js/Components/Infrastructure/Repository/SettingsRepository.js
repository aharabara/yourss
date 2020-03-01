import db from "../Database";

class SettingsRepository {

  constructor(database) {
    /** @type Dexie database */
    this.database = database;
  }

  async set(key, value) {
    let exists = await this.database.settings.where('key').equals(key).count();
    if(exists > 0){
      await this.database.settings.where('key').equals(key).modify({key, value});
    }else{
      await this.database.settings.add({key, value});
    }
  }

  async get(key) {
    return this.database
      .settings
      .where('key').equals(key)
      .limit(1)
      .first();
  }
}

export default new SettingsRepository(db);