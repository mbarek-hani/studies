import mongoose from "mongoose";

mongoose.connect(process.env.DB_URL)
    .then(()=>console.log('connected to database successfully.'))
    .catch((error)=>console.log(error.message));