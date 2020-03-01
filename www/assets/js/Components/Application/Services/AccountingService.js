import axios from "axios";
import SettingsRepository from "../../Infrastructure/Repository/SettingsRepository";

const AccountingService = class AccountingService {

  constructor(SettingsRepository) {
    this.SettingsRepository = SettingsRepository;
  }

  async login(username, password) {
    const service = this;
    return await axios.post("/api/login", {
      username: username,
      password: password
    }).then(function () {
      service.SettingsRepository.set('is-logged-in', true);
      return true;
    }).catch(function () {
      service.SettingsRepository.set('is-logged-in', false);
      return false;
    })
  }

  isLogged(){
    return this.SettingsRepository.get('is-logged-in')
  }
};
export default new AccountingService(SettingsRepository)