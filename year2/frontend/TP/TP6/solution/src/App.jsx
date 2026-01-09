import { useState } from "react";

export default function App() {
  const [formData, setFormData] = useState({
    username: "",
    email: "",
    password: "",
    confirmPassword: "",
    birthDate: "",
    gender: "",
    country: "",
    bio: "",
    photo: null,
    photoPreview: "",
    interests: [],
    cgu: false,
    newsletter: false,
  });

  const [errors, setErrors] = useState({});
  const [submitted, setSubmitted] = useState(false);

  /* -------------------- HANDLERS -------------------- */

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === "checkbox" ? checked : value,
    });
  };

  const handleCheckboxGroup = (e) => {
    const { value, checked } = e.target;
    setFormData((prev) => ({
      ...prev,
      interests: checked
        ? [...prev.interests, value]
        : prev.interests.filter((i) => i !== value),
    }));
  };

  const handleFileChange = (e) => {
    const file = e.target.files[0];
    if (file && file.type.startsWith("image/")) {
      setFormData({
        ...formData,
        photo: file,
        photoPreview: URL.createObjectURL(file),
      });
    }
  };

  /* -------------------- VALIDATION -------------------- */

  const validate = () => {
    const newErrors = {};

    if (formData.username.length < 3)
      newErrors.username = "Minimum 3 caractères";

    if (!/^\S+@\S+\.\S+$/.test(formData.email))
      newErrors.email = "Email invalide";

    if (formData.password.length < 8)
      newErrors.password = "Minimum 8 caractères";

    if (formData.password !== formData.confirmPassword)
      newErrors.confirmPassword = "Les mots de passe ne correspondent pas";

    if (!formData.birthDate) newErrors.birthDate = "Champ obligatoire";
    if (!formData.gender) newErrors.gender = "Champ obligatoire";
    if (!formData.country) newErrors.country = "Champ obligatoire";

    if (formData.bio.length > 200) newErrors.bio = "Max 200 caractères";

    if (formData.interests.length === 0)
      newErrors.interests = "Choisissez au moins un intérêt";

    if (!formData.cgu) newErrors.cgu = "Vous devez accepter les CGU";

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  /* ------------------- SUBMIT -------------------- */

  const handleSubmit = (e) => {
    e.preventDefault();
    if (validate()) {
      console.log("Données valides :", formData);
      setSubmitted(true);
      setFormData({
        username: "",
        email: "",
        password: "",
        confirmPassword: "",
        birthDate: "",
        gender: "",
        country: "",
        bio: "",
        photo: null,
        photoPreview: "",
        interests: [],
        cgu: false,
        newsletter: false,
      });
      setErrors({});
    }
  };

  /* -------------------- UI -------------------- */

  return (
    <div className="max-w-2xl mx-auto p-6 bg-white shadow rounded">
      <h1 className="text-2xl font-bold mb-4">Inscription</h1>

      {submitted && <p className="text-green-600 mb-4">Inscription réussie</p>}

      <form onSubmit={handleSubmit} className="space-y-4">
        {/* Username */}
        <input
          name="username"
          placeholder="Nom d'utilisateur"
          value={formData.username}
          onChange={handleChange}
          className="w-full border p-2 rounded"
        />
        <p className="text-red-500 text-sm">{errors.username}</p>

        {/* Email */}
        <input
          name="email"
          placeholder="Email"
          value={formData.email}
          onChange={handleChange}
          className="w-full border p-2 rounded"
        />
        <p className="text-red-500 text-sm">{errors.email}</p>

        {/* Password */}
        <input
          type="password"
          name="password"
          placeholder="Mot de passe"
          value={formData.password}
          onChange={handleChange}
          className="w-full border p-2 rounded"
        />
        <p className="text-red-500 text-sm">{errors.password}</p>

        <input
          type="password"
          name="confirmPassword"
          placeholder="Confirmation"
          value={formData.confirmPassword}
          onChange={handleChange}
          className="w-full border p-2 rounded"
        />
        <p className="text-red-500 text-sm">{errors.confirmPassword}</p>

        {/* Date */}
        <input
          type="date"
          name="birthDate"
          onChange={handleChange}
          className="w-full border p-2 rounded"
        />
        <p className="text-red-500 text-sm">{errors.birthDate}</p>

        {/* Gender */}
        <div className="flex gap-4">
          {["Homme", "Femme", "Autre"].map((g) => (
            <label key={g}>
              <input
                type="radio"
                name="gender"
                value={g}
                onChange={handleChange}
              />{" "}
              {g}
            </label>
          ))}
          <p className="text-red-500 text-sm">{errors.gender}</p>
        </div>

        {/* Country */}
        <select
          name="country"
          onChange={handleChange}
          value={formData.country}
          className="w-full border p-2 rounded"
        >
          <option value="">Pays</option>
          <option>Maroc</option>
          <option>France</option>
          <option>Canada</option>
        </select>
        <p className="text-red-500 text-sm">{errors.country}</p>

        {/* Bio */}
        <textarea
          name="bio"
          onChange={handleChange}
          className="w-full border p-2 rounded"
          placeholder="Bio (200 caractères max)"
        />
        <p className="text-red-500 text-sm">{errors.bio}</p>

        {/* Photo */}
        <input type="file" onChange={handleFileChange} />
        <p className="text-red-500 text-sm">{errors.photo}</p>
        {formData.photoPreview && (
          <img
            src={formData.photoPreview}
            className="w-24 h-24 object-cover rounded"
          />
        )}

        {/* Interests */}
        <div>
          {["Sport", "Musique", "Lecture", "Voyage"].map((i) => (
            <label key={i} className="block">
              <input type="checkbox" value={i} onChange={handleCheckboxGroup} />{" "}
              {i}
            </label>
          ))}
        </div>
        <p className="text-red-500 text-sm">{errors.interests}</p>

        {/* CGU */}
        <label>
          <input
            type="checkbox"
            name="cgu"
            checked={formData.cgu}
            onChange={handleChange}
          />{" "}
          J'accepte les CGU
        </label>
        <p className="text-red-500 text-sm">{errors.cgu}</p>

        {/* Submit */}
        <button
          disabled={!formData.cgu}
          className={`w-full p-2 rounded text-white ${
            formData.cgu ? "bg-blue-600 cursor-pointer" : "bg-gray-400"
          }`}
        >
          S'inscrire
        </button>
      </form>
    </div>
  );
}
