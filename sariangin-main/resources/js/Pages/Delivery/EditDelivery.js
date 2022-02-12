import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Card, Col, Form, Input, Row } from "antd";
import { routes } from "@/routes";
import { DeliveryForm } from "@/Components/Forms/DeliveryForm/DeliveryForm";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import dayjs from "dayjs";
import { NoteList } from "@/Components/Delivery/NoteList/NoteList";

export default function EditDelivery({
  delivery,
  deliveryTypes,
  customers,
  tankCategories,
  drivers,
  vehicles,
}) {
  const [form] = Form.useForm();

  const handleFinish = (values) => {
    Inertia.post(route(routes.DELIVERIES_UPDATE, delivery.id), values);
  };

  return (
    <Row justify="center" className="da-mb-1">
      <Col lg={18}>
        <Row gutter={[0, 32]}>
          <Breadcrumbs
            breadcrumbs={[
              { name: "Surat Jalan", route: routes.DELIVERIES_INDEX },
              { name: "Ubah Surat Jalan" },
            ]}
          />
          <Col span={24}>
            <Card className="da-border-color-black-40">
              <Row gutter={[0, 32]}>
                <Col span={24}>
                  <h4>Ubah Surat Jalan</h4>
                  {/* <p className="da-p1-body">Master Data</p> */}
                </Col>

                <Col span={24}>
                  <DeliveryForm
                    name="edit-delivery"
                    form={form}
                    onFinish={handleFinish}
                    deliveryTypes={deliveryTypes}
                    customers={customers}
                    tankCategories={tankCategories}
                    drivers={drivers}
                    vehicles={vehicles}
                    initialValues={{ ...delivery, date: dayjs(delivery.date) }}
                  />
                </Col>

                <Col span={24}>
                  <NoteList notes={delivery.notes} title="Informasi Tambahan" />
                </Col>
              </Row>
            </Card>
          </Col>
        </Row>
      </Col>
    </Row>
  );
}
